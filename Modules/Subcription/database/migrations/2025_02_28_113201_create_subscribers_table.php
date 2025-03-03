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
        Schema::create('subscribers', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade'); 
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('name');
            $table->enum('status', ['active', 'inactive', 'pending'])->default('pending');
            $table->timestamp('subscribed_at')->default(now());
            $table->timestamp('expires_at')->nullable();
            $table->tinyInteger('delete_status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscribers');
    }
};
