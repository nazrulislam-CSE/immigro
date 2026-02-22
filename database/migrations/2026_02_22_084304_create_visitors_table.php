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
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('mobile')->nullable();
            $table->string('interacted_country')->nullable();
            $table->string('visa_category')->nullable(); // will hold values like "Work permit"
            $table->date('date')->nullable();
            $table->date('next_followup')->nullable();
            $table->enum('followup_result', ['yes', 'no', 'pending'])->nullable();
            $table->text('comments')->nullable();
            $table->string('counsellor_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitors');
    }
};
