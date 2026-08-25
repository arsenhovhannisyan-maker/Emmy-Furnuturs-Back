<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Guarded per-column so a crash/timeout partway through this method (the
        // backfill below issues one UPDATE per legacy photo with no batching, which
        // can take a while on a large files table) doesn't permanently brick the next
        // `php artisan migrate` with a duplicate-column error - confirmed by hand that
        // re-running this method is otherwise safe (the backfill's own regex already
        // skips rows already renamed to "photos").
        if (!Schema::hasColumn('files', 'product_size_id')) {
            Schema::table('files', function (Blueprint $table) {
                $table->foreignId('product_size_id')->nullable()->after('fileable_id')
                    ->constrained('product_sizes')->nullOnDelete();
            });
        }

        if (!Schema::hasColumn('files', 'sort_order')) {
            Schema::table('files', function (Blueprint $table) {
                $table->unsignedInteger('sort_order')->default(0)->after('product_size_id');
            });
        }

        $this->backfillProductPhotos();
    }

    /**
     * Deliberately refuses to roll back: dropping these columns after up() has
     * already renamed photo1..photo48 to "photos" would silently discard every
     * photo's size grouping and order with no way to recompute it (the original
     * slot number is gone). Confirmed by hand - rollback+re-migrate on already
     * -backfilled data reset product_size_id to null while leaving field_name
     * as "photos", so the loss is silent unless this guard is here. If a
     * rollback is truly needed, restore the files table from a backup instead.
     */
    public function down(): void
    {
        throw new \RuntimeException(
            'This migration cannot be safely rolled back once any product photo has been ' .
            'backfilled: dropping product_size_id/sort_order here would silently strip every ' .
            'photo\'s size grouping and order, and it cannot be recomputed afterwards ' .
            '(field_name is already renamed to "photos" by then). Restore the files table ' .
            'from a backup instead of rolling back.'
        );
    }

    /**
     * Old scheme: each photo lived in its own field_name slot (photo1..photo48),
     * 6 slots per size in size-creation order. New scheme: all product photos
     * share field_name "photos" and are grouped by product_size_id + ordered
     * by sort_order. This backfills existing rows into the new scheme so no
     * photo already on a live product goes missing after this migration.
     */
    private function backfillProductPhotos(): void
    {
        $productClass = 'App\\Models\\Product\\Product';

        $files = DB::table('files')
            ->where('fileable_type', $productClass)
            ->where('field_name', 'like', 'photo%')
            ->get();

        if ($files->isEmpty()) {
            return;
        }

        // Scoped to only the products that actually have a legacy photo, rather than
        // loading every product_sizes row in the system - keeps this cheap regardless
        // of total catalog size.
        $productIds = $files->pluck('fileable_id')->unique()->values();

        $sizesByProduct = DB::table('product_sizes')
            ->whereIn('product_id', $productIds)
            ->orderBy('product_id')
            ->orderBy('id')
            ->get()
            ->groupBy('product_id');

        DB::transaction(function () use ($files, $sizesByProduct): void {
            foreach ($files as $file) {
                if (!preg_match('/^photo(\d+)$/', $file->field_name, $m)) {
                    continue;
                }

                $slot = ((int) $m[1]) - 1;
                $sizeIndex = intdiv($slot, 6);
                $position = $slot % 6;

                $sizes = $sizesByProduct->get($file->fileable_id, collect())->values();
                $size = $sizes->get($sizeIndex);

                DB::table('files')->where('id', $file->id)->update([
                    'product_size_id' => $size?->id,
                    'sort_order' => $position,
                    'field_name' => 'photos',
                ]);
            }
        });
    }
};
