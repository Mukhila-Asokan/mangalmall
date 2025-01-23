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
        Schema::create('venueamenitiespricing', function (Blueprint $table) {
            $table->id();
            $table->integer('venue_id');
            $table->string('amenity_name');
            $table->integer('amenity_id');
            $table->integer('description');
            $table->boolean('is_complimentary')->default(0);
            $table->decimal('additional_cost',7,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venueamenitiespricing');
    }
};
