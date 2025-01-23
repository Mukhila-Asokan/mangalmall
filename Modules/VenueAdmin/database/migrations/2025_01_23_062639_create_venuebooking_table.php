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
        Schema::create('venuebooking', function (Blueprint $table) {
            $table->id();
            $table->integer('venue_id');
            $table->enum('booked_by',['VenueUser', 'MangalMallUser'])->default('VenueUser'); 
            $table->integer('bookinguserid');
            $table->integer('event_id');
            $table->datetime('start_datetime');
            $table->datetime('end_datetime');
            $table->string('total_guests');
            $table->enum('booking_status',['Pending', 'Confirmed', 'Cancelled', 'Completed'])->default('Confirmed'); 
            $table->decimal('total_price',7,2);
            $table->enum('payment_status',['Unpaid', 'Partial', 'Paid'])->default('Unpaid');
            $table->text('special_requirements');
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
        Schema::dropIfExists('venuebooking');
    }
};
