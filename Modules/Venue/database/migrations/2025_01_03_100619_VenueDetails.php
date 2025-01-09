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
        Schema::create('venuedetails', function (Blueprint $table) {
            $table->id();
            $table->string('venuename');  
            $table->string('venueaddress');         
            $table->string('locationid');         
            $table->text('description');         
            $table->string('contactperson');         
            $table->string('contactmobile');         
            $table->string('contacttelephone');         
            $table->string('contactemail');         
            $table->string('websitename');         
            $table->tinyInteger('venuetypeid');         
            $table->tinyInteger('venuesubtypeid');         
            $table->text('venueamenities');         
            $table->text('venuedata');         
            $table->text('bannerimage');         
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
         Schema::dropIfExists('venuedetails');
    }
};
