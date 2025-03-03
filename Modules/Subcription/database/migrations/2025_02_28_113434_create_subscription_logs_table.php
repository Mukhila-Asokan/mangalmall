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
        Schema::create('subscription_logs', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->foreignId('subscriber_id')->constrained('subscribers')->onDelete('cascade'); // Links to subscribers table
            $table->foreignId('subscription_id')->constrained('subscriber_subscriptions')->onDelete('cascade'); // Links to subscriber_subscriptions table
            $table->enum('action', ['subscribed', 'canceled', 'renewed', 'expired'])->notNull(); // Subscription action
            $table->text('log_message'); // Description of the action
            $table->timestamp('created_at')->default(now()); // Log entry timestamp
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_logs');
    }
};
