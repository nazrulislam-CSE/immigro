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
        Schema::create('visas', function (Blueprint $table) {
            $table->id();
            $table->string('country_name')->nullable();
            $table->string('slug')->nullable();
            $table->string('image')->nullable();
            $table->string('banner')->nullable();
            $table->string('t_banner')->nullable();
            $table->string('t_image')->nullable();
            $table->string('t_country_name')->nullable();
            $table->string('t_clients_name')->nullable();
            $table->string('t_passport_number')->nullable();
            $table->string('t_phone')->nullable();
            $table->string('t_processing_time')->nullable();
            $table->string('t_agent_name')->nullable();
            $table->double('t_agent_price')->default(0.00)->nullable();
            $table->string('t_customer_price')->nullable();
            $table->string('t_visa_duration')->nullable();
            $table->string('work_types')->nullable(); 
            $table->string('contact_year')->nullable(); 
            $table->double('basic_salary')->default(0.00)->nullable();
            $table->string('overtime')->nullable(); 
            $table->string('weekend')->nullable(); 
            $table->string('accommodation_cost')->nullable();
            $table->double('advance_payment')->default(0.00)->nullable();
            $table->string('after_work_permit')->nullable();
            $table->string('after_visa')->nullable();
            $table->double('total_cost')->default(0.00)->nullable();
            $table->string('duration_visa')->nullable();
            $table->string('visa_processing_time')->nullable();
            $table->longtext('documents')->nullable();
            $table->longtext('t_documents')->nullable();
            $table->unsignedTinyInteger('visa_type')->default(1)->comment('1=>Tourist Visa, 2=>Work Permit Visa');
            $table->unsignedTinyInteger('status')->default(1)->comment('1=>Active, 0=>Inactive');
            $table->unsignedTinyInteger('t_status')->default(1)->comment('1=>Active, 0=>Inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visas');
    }
};
