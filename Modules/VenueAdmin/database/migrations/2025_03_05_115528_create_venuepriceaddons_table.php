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
        Schema::create('venuepriceaddons', function (Blueprint $table) {
            $table->id();
            $table->string('addonname'); 
            $table->string('price');
            $table->enum('status',['Active', 'Inactive'])->default('Active'); 
            $table->string('delete_status')->default('0');
            $table->string('addon_description')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venuepriceaddons');
    }
};
