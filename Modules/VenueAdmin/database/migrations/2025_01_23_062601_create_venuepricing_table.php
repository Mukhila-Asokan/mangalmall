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
        Schema::create('venuepricing', function (Blueprint $table) {
            $table->id();
            $table->integer('venue_id');
            $table->enum('pricing_type',['Hourly', 'Day', 'Weekend', 'Custom'])->default('Day'); 
            $table->decimal('base_price',5,2);
            $table->decimal('peak_rate',5,2);
            $table->decimal('deposit_amount',7,2);
            $table->text('cancellation_policy');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venuepricing');
    }
};
