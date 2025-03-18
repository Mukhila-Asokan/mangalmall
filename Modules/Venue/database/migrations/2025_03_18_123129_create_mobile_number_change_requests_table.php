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
        Schema::create('mobile_number_change_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('venue_admin_id')->nullable();
            $table->bigInteger('exisiting_mobile_number')->nullable();
            $table->bigInteger('new_mobile_number')->nullable();
            $table->boolean('is_approved')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mobile_number_change_requests');
    }
};
