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
        Schema::create('bloganalytics', function (Blueprint $table) {
            $table->id();        
            $table->unsignedBigInteger('user_id');
            $table->string('totalblogs');   
            $table->string('totalblogviews');
            $table->string('totalbloglikes');
            $table->string('totalblogdislikes');
            $table->string('totalblogcomments');
            $table->string('totalblogshares');
            $table->string('totalblograting');
            $table->string('totalblogratingusers');       
            $table->enum('status',['Active', 'Inactive'])->default('Active'); 
            $table->tinyInteger('delete_status')->default('0');   
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bloganalytics');
    }
};
