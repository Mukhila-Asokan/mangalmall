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
        Schema::create('subscriber_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subscriber_id')->constrained('subscribers')->onDelete('cascade'); // Links to subscribers table
            $table->foreignId('plan_id')->constrained('subscribers_plans')->onDelete('cascade'); // Links to subscription_plans table
            $table->enum('status', ['active', 'expired', 'canceled'])->default('active'); // Subscription status
            $table->timestamp('start_date')->default(now()); // Subscription start date
            $table->timestamp('end_date')->nullable(); // Subscription expiration date
            $table->enum('payment_status', ['pending', 'paid', 'failed'])->default('pending'); // Payment status
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriber_subcriptions');
    }
};
