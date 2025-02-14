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
        Schema::create('venue_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('venue_id'); // Foreign key to venues table
            $table->string('image_path'); // Path to the image
            $table->timestamps();

            $table->foreign('venue_id')->references('id')->on('venuedetails')->onDelete('cascade'); // If venue is deleted, delete its images
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venue_images');
    }
};
