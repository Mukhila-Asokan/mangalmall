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
        Schema::create('event_checklist_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('checklistcategories')->onDelete('cascade');
            $table->foreignId('occasion_id')->constrained('occasion_types')->onDelete('cascade');
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
        Schema::dropIfExists('event_checklist_assignments');
    }
};
