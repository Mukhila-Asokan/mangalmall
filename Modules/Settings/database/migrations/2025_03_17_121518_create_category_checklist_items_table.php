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
        Schema::create('category_checklist_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('checklistcategories')->onDelete('cascade');
            $table->string('item_name');  // Each checklist item
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
        Schema::dropIfExists('category_checklist_items');
    }
};
