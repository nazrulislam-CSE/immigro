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
        Schema::create('supplier_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supplier_id');
            $table->string('payment_category')->nullable();
            $table->decimal('total_amount', 10, 2)->nullable();
            $table->decimal('total_pay', 10, 2)->nullable();
            $table->decimal('due', 10, 2)->nullable();
            $table->date('due_pay_date')->nullable();
            $table->date('date')->nullable();
            $table->text('payment_purpose')->nullable();
            $table->string('applicable_fee')->nullable(); // Advance/Documents
            $table->string('visa_category')->nullable();
            $table->timestamps();

            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_payments');
    }
};
