<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('basket_items', function (Blueprint $table) {
            $table->foreignId('product_size_id')
                ->nullable()
                ->after('product_id')
                ->constrained('product_sizes')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('basket_items', function (Blueprint $table) {
            $table->dropForeign(['product_size_id']);
        });
    }
};
