<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->nullable()->constrained('products')->nullOnDelete();
            $table->decimal('customer_price', 10, 2)->default(0);
            $table->integer('quantity')->default(1);
            $table->string('customer_name');
            $table->string('mobile_number');
            $table->decimal('shipping_cost', 10, 2)->default(0);
            $table->decimal('advance_payment', 10, 2)->default(0);
            $table->string('payment_method')->nullable();
            $table->text('shipping_address');
            $table->string('thana')->nullable();
            $table->string('district')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_orders');
    }
};
