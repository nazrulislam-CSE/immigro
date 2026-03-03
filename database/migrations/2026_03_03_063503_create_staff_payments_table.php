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
        Schema::create('staff_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('staff_id');
            $table->date('payment_date');
            $table->decimal('amount', 10, 2);
            $table->string('payment_type')->nullable(); // salary, advance, bonus, etc.
            $table->string('payment_method')->nullable(); // cash, bank, bkash, nagad, rocket
            $table->string('reference')->nullable(); // cheque no, transaction id
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('staff_id')->references('id')->on('staff')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff_payments');
    }
};
