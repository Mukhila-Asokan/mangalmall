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
        Schema::create('venueavailability', function (Blueprint $table) {
            $table->id();
            $table->integer('venue_id');
            $table->date('venue_bookingdate');
            $table->time('bookingstart_time');
            $table->time('bookingend_time');
            $table->boolean('is_available')->default('0');
            $table->text('blocked_reason');
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
        Schema::dropIfExists('venueavailability');
    }
};
