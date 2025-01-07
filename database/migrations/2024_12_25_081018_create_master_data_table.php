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
        Schema::create('master_data', function (Blueprint $table) {
            $table->id();
            $table->string('month')->nullable();
            $table->date('date')->nullable(); 
            $table->string('description')->nullable();
            $table->string('type')->nullable();
            $table->string('claim_number')->nullable();
            $table->string('supplier')->nullable();
            $table->string('brand')->nullable();
            $table->string('car_type')->nullable();
            $table->string('model')->nullable();
            $table->string('vin')->nullable();
            $table->string('chassis_number');
            $table->string('color')->nullable();
            $table->string('storage_location')->nullable();
            $table->integer('incoming')->nullable();
            $table->string('dealer')->nullable();
            $table->string('customer')->nullable();
            $table->integer('outgoing')->nullable();
            $table->integer('stock_balance')->nullable();
            $table->integer('claim_balance')->nullable();
            $table->date('purchase_date')->nullable();
            $table->integer('claim_count')->nullable();
            $table->integer('received_count')->nullable();
            $table->date('claim_date')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_data');
    }
};
