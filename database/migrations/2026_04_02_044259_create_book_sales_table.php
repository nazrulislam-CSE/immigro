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
        Schema::create('book_sales', function (Blueprint $table) {
            $table->id();
            $table->string('book_name')->nullable();
            $table->string('writer_name')->nullable();
            $table->string('photo')->nullable();
            $table->string('page')->nullable();
            $table->double('price')->default(0.00)->nullable();
            $table->double('discount')->default(0.00)->nullable();
            $table->double('seller_price')->default(0.00)->nullable();
            $table->double('customer_price')->default(0.00)->nullable();
            $table->unsignedTinyInteger('status')->default(0)->comment('0=pending, 1=approved, 2=paid, 3=delivery');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_sales');
    }
};
