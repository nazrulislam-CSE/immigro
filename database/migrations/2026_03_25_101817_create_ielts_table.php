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
        Schema::create('ielts', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('image')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('birth_day')->nullable();
            $table->string('school_name')->nullable();
            $table->string('school_passing_year')->nullable();
            $table->string('school_gpa')->nullable();
            $table->string('collage_name')->nullable();
            $table->string('collage_passing_year')->nullable();
            $table->string('collage_gpa')->nullable();
            $table->string('department')->nullable();
            $table->string('subject')->nullable();
            $table->string('country')->nullable();
            $table->string('proficiency')->nullable();
            $table->string('study_type')->nullable();
            $table->string('address')->nullable();
            $table->string('village')->nullable();
            $table->string('thana')->nullable();
            $table->string('district')->nullable();
            $table->text('message')->nullable();
            $table->unsignedTinyInteger('status')->default(1)->comment('1=>Active, 0=>Inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ielts');
    }
};
