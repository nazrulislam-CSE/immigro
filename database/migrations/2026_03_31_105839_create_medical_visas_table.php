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
        Schema::create('medical_visas', function (Blueprint $table) {
            $table->id();
            $table->string('country_name')->nullable();
            $table->string('slug')->nullable();
            $table->string('flug')->nullable();
            $table->string('visa_type')->nullable();
            $table->string('visa_duration')->nullable();
            $table->double('apply_fee')->default(0.00)->nullable();
            $table->string('processing_time')->nullable();
            $table->date('publish_date')->nullable();
            $table->string('service_charge')->nullable();
            $table->double('visa_fee')->default(0.00)->nullable();
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
        Schema::dropIfExists('medical_visas');
    }
};
