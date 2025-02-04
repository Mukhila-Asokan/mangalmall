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
        Schema::create('venuebooking_addons', function (Blueprint $table) {
            $table->id();
            $table->integer('venue_id');
            $table->integer('venuebooking_id');
            $table->string('addon_name');
            $table->string('quantity');
            $table->decimal('price_per_unit',7,2);
            $table->decimal('total_price',7,2);
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
        Schema::dropIfExists('venuebooking_addons');
    }
};
