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
        Schema::create('usermedia', function (Blueprint $table) {
            $table->id();
            $table->string('filename');
            $table->string('path');
            $table->enum('type', ['image', 'audio', 'video']);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->json('metadata')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usermedia');
    }
};
