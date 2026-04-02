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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('photo')->nullable();
            $table->string('brand_name')->nullable();
            $table->string('size')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->string('color')->nullable();
            $table->decimal('discount', 5, 2)->default(0)->comment('percentage');
            $table->decimal('seller_price', 10, 2)->default(0);
            $table->decimal('customer_price', 10, 2)->default(0);
            $table->text('note')->nullable();
            $table->boolean('status')->default(1)->comment('1=active, 0=inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
