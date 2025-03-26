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
        Schema::create('invitationdigitalcard_size', function (Blueprint $table) {
            $table->id();
            $table->string('size_name');
            $table->string('size_width');
            $table->string('size_height');
            $table->enum('Status', ['Active', 'Inactive'])->default('Active');
            $table->enum('delete_status', ['0', '1'])->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invitationdigitalcard_size');
    }
};
