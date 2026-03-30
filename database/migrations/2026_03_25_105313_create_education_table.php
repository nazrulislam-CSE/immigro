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
        Schema::create('education', function (Blueprint $table) {
            $table->id();
            $table->string('course_name')->nullable();
            $table->string('slug')->nullable();
            $table->string('coordinator_photo')->nullable();
            $table->string('image')->nullable();
            $table->string('banner')->nullable();
            $table->unsignedTinyInteger('study_type')->default(1)->comment('1=>Bachelor, 2=>Masters,3=>Nursing,4=>Diploma,5=>PHd');
            $table->double('course_fee')->default(0.00)->nullable();
            $table->double('discount')->default(0.00)->nullable();
            $table->double('gross_course_fee')->default(0.00)->nullable();
            $table->string('duration')->nullable();
            $table->string('coordinator_name')->nullable();
            $table->string('experience')->nullable();
            $table->longtext('course_materials')->nullable();
            $table->unsignedTinyInteger('status')->default(1)->comment('1=>Active, 0=>Inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education');
    }
};
