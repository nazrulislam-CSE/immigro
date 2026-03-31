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
        Schema::create('student_visas', function (Blueprint $table) {
            $table->id();
            $table->string('country_name')->nullable();
            $table->string('slug')->nullable();
            $table->string('flug')->nullable();
            $table->string('program')->nullable();
            $table->string('versity_name')->nullable();
            $table->string('logo')->nullable();
            $table->string('intake')->nullable();
            $table->string('ielts')->nullable();
            $table->double('application_fee')->default(0.00)->nullable();
            $table->double('averse_tution_fee')->default(0.00)->nullable();
            $table->double('acommodation_cost')->default(0.00)->nullable();
            $table->string('processing_time')->nullable();
            $table->double('medical_fee')->default(0.00)->nullable();
            $table->string('service_charge')->nullable();
            $table->longtext('documents')->nullable();
            $table->unsignedTinyInteger('status')->default(1)->comment('1=>Active, 0=>Inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_visas');
    }
};
