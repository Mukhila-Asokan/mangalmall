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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subscriber_id')->constrained('subscribers')->onDelete('cascade'); // Links to subscribers table
            $table->foreignId('subscription_id')->constrained('subscriber_subscriptions')->onDelete('cascade'); // Links to subscriber_subscriptions table
            $table->string('transaction_id')->unique(); // Unique transaction ID
            $table->decimal('amount', 10, 2); // Payment amount
            $table->enum('status', ['pending', 'completed', 'failed'])->default('pending'); // Payment status
            $table->enum('payment_method', ['paypal', 'stripe', 'razorpay', 'bank_transfer'])->notNull(); // Payment method
            $table->timestamp('paid_at')->nullable(); // Payment completion time
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
