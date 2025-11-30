<?php

use App\Models\Order\Order;
use App\Models\Product\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Order::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Product::class)->constrained()->cascadeOnDelete();

            $table->unsignedInteger('quantity')->default(1);
            $table->decimal('price', 10, 2)->default(0);

            // Total = price * quantity
            $table->decimal('total', 10, 2)->default(0)
                ->comment('price * quantity');

            $table->timestamps();

            // Indexes
            $table->index('order_id');
            $table->index('product_id');
            $table->index(['order_id', 'product_id'], 'order_items_order_product_index');
        });

        // Auto-fill total for existing data
        DB::statement('
            UPDATE order_items
            SET total = price * quantity
        ');
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};