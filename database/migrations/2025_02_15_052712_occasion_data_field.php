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
        Schema::create('occasiondatafields', function (Blueprint $table) {
            $table->id();
            $table->string('datafieldname'); 
            $table->string('datafieldtype'); 
            $table->unsignedBigInteger('occasion_id');
            $table->foreign('occasion_id')->references('id')->on('occasion_types')->onDelete('cascade');
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
        Schema::dropIfExists('occasiondatafields');
    }
};
