<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('product_sizes', 'characteristics')) {
            Schema::table('product_sizes', function (Blueprint $table) {
                $table->text('characteristics')->nullable();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('product_sizes', 'characteristics')) {
            Schema::table('product_sizes', function (Blueprint $table) {
                $table->dropColumn('characteristics');
            });
        }
    }
};
