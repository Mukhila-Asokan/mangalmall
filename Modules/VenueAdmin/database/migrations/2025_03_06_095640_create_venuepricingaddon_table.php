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
        Schema::create('venuepricingaddon', function (Blueprint $table) {
            $table->id();
            $table->integer('venuepricingid');
            $table->integer('addonid');
            $table->integer('addonprice');
            $table->integer('created_by');  
            $table->integer('delete_status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venuepricingaddon');
    }
};
