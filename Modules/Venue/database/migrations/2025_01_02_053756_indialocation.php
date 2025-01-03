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
         Schema::create('Indialocations', function (Blueprint $table) {
            $table->id();
            $table->string('Areaname');  
            $table->string('Pincode');         
            $table->string('City');         
            $table->string('District');         
            $table->string('State');         
            $table->enum('status',['Active', 'Inactive'])->default('Active'); 
            $table->tinyInteger('delete_status')->default('0');   
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Indialocations');
    }
};
