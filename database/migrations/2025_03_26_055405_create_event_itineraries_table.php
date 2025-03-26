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
        Schema::create('event_itinerary', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id')->nullable();
            $table->foreign('event_id')->references('id')->on('user_occasions')->onDelete('cascade');
            $table->string('label')->nullable();
            $table->text('description')->nullable();
            $table->date('date')->nullable();
            $table->string('start_time_value')->nullable();
            $table->string('start_time_label')->nullable();
            $table->string('end_time_value')->nullable();
            $table->string('end_time_label')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_itinerary');
    }
};
