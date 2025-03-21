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
        Schema::create('userbudget', function (Blueprint $table) {
            $table->id();          
            $table->string('name');
            $table->foreignId('occasion_id')->constrained('occasion_types')->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('planned_amount', 12, 2)->default(0);
            $table->decimal('completed_amount', 12, 2)->default(0);
            $table->text('description')->nullable();
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
        Schema::dropIfExists('userbudget');
    }
};
