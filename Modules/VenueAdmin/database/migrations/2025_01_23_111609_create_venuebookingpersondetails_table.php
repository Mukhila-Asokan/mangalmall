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
        Schema::create('venuebookingpersondetails', function (Blueprint $table) {
            $table->id();
            $table->integer('venue_id');
            $table->integer('venuebooking_id');
            $table->string('person_name');
            $table->string('mobileno');
            $table->text('contact_address');
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
        Schema::dropIfExists('venuebookingpersondetails');
    }
};
