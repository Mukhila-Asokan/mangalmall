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
        Schema::create('venue_ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('venue_id')->constrained('venuedetails')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->integer('rating')->comment('1-5 star rating');
            $table->text('review')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->string('booking_reference')->nullable();           
            $table->softDeletes();            
            // Prevent duplicate ratings from same user for same venue
            $table->unique(['venue_id', 'user_id']);
            $table->timestamps();
        });

        Schema::create('venue_rating_criteria', function (Blueprint $table) {
            $table->id();
            $table->foreignId('venue_rating_id')->constrained('venue_ratings')->onDelete('cascade');
            $table->integer('cleanliness')->default(0);
            $table->integer('service')->default(0);
            $table->integer('value_for_money')->default(0);
            $table->integer('location')->default(0);
            $table->integer('amenities')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venue_ratings');
        Schema::dropIfExists('venue_rating_criteria');
        
    }
};
