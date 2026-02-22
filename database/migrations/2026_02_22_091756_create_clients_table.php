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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('client_name');
            $table->string('phone_number')->nullable();
            $table->text('address')->nullable();
            $table->string('country_name')->nullable();
            $table->string('work_category')->nullable();
            $table->string('processing_time')->nullable();
            $table->date('date')->nullable();
            $table->string('visa_category')->nullable();
            $table->string('transport_number')->nullable();
            $table->decimal('total_amount', 10, 2)->nullable();
            $table->string('agent_name')->nullable();
            $table->string('agent_id')->nullable(); // could be foreign key later
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
