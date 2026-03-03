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
        Schema::create('passports', function (Blueprint $table) {
            $table->id();
            $table->string('client_name');
            $table->string('mobile_no')->nullable();
            $table->string('visa_type')->nullable();
            $table->string('passport_number')->unique();
            $table->text('address')->nullable();
            $table->string('country')->nullable();
            $table->date('date')->nullable();
            $table->string('received_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('passports');
    }
};
