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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no')->unique();
            $table->unsignedBigInteger('client_id');
            $table->string('mobile')->nullable();          // from client, but stored for record
            $table->string('country_name')->nullable();    // from client
            $table->decimal('total_amount', 10, 2)->nullable();
            $table->decimal('advance_pay', 10, 2)->nullable();
            $table->decimal('due', 10, 2)->nullable();
            $table->string('processing_time')->nullable();
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
