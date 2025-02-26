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
        Schema::create('themesettings', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('data_key');
            $table->text('data_value');
            $table->enum('status', ['Active', 'Inactive'])->default('Active');    
            $table->tinyInteger('delete_status')->default(0);      
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('themesettings');
    }
};
