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
        Schema::create('subscribers_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Unique subscription plan name
            $table->text('description')->nullable(); // Optional description
            $table->decimal('price', 10, 2); // Price with two decimal points
            $table->integer('duration'); // Duration in days 1 month 
            $table->enum('status', ['active', 'inactive'])->default('active'); // Plan status
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscribers_plans');
    }
};
