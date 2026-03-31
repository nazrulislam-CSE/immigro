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
        Schema::create('software_sales', function (Blueprint $table) {
            $table->id();
            $table->string('software_name')->nullable();
            $table->string('demo_link')->nullable();
            $table->double('price')->default(0.00)->nullable();
            $table->double('discount')->default(0.00)->nullable();
            $table->double('sell_comission')->default(0.00)->nullable();
            $table->double('monthly_charge')->default(0.00)->nullable();
            $table->longtext('facilities')->nullable();
            $table->unsignedTinyInteger('status')->default(1)->comment('1=>Active, 0=>Inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('software_sales');
    }
};
