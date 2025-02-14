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
        Schema::create('venue_content', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('venue_id'); // Foreign key to venues table
            $table->text('description'); // Path to the content
            $table->text('key_features'); // Path to the content
            $table->text('ambience'); // Path to the content
            $table->text('event_sustability'); 
            $table->text('amenities'); 
            $table->text('policy');
            $table->timestamps();

            $table->foreign('venue_id')->references('id')->on('venuedetails')->onDelete('cascade'); // If venue is deleted, delete its content
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venue_content');
    }
};
