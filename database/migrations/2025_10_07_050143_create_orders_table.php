<?php

use App\Models\User\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // User
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();

            // Identification
            $table->string('order_number')->unique();

            // Money
            $table->decimal('total', 10, 2);
            $table->decimal('subtotal', 10, 2)->nullable();
            $table->decimal('tax', 10, 2)->default(0);
            $table->decimal('shipping_cost', 10, 2)->default(0);

            // Status
            $table->string('status')->default('pending');

            // Shipping info
            $table->string('shipping_first_name');
            $table->string('shipping_last_name');
            $table->string('shipping_company')->nullable();
            $table->text('shipping_address');
            $table->string('shipping_city');
            $table->string('shipping_state')->nullable();
            $table->string('shipping_country')->nullable();
            $table->string('shipping_zip_code')->nullable();
            $table->string('shipping_email');
            $table->string('shipping_phone');

            // Other
            $table->text('notes')->nullable();

            $table->timestamps();

            // Indexes
            $table->index(['user_id', 'status']);
            $table->index('order_number');
            $table->index('shipping_email');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};