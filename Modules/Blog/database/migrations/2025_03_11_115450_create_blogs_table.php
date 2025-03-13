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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('image')->nullable();         
            $table->string('image_title')->nullable();           
            $table->string('image_url')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('title'); 
            $table->string('category')->nullable();
            $table->string('tags')->nullable();                     
            $table->string('blog_url')->nullable();         
            $table->longText('content');
            $table->string('views')->default(0);   
            $table->string('likes')->default(0);
            $table->string('dislikes')->default(0);
            $table->string('comments')->default(0);  
            $table->decimal('rating', 3, 2)->nullable();         
            $table->string('seo_title')->nullable();
            $table->enum('blogstatus', ['draft', 'pending', 'published', 'rejected'])->default('draft');
            $table->string('seo_description')->nullable();
            $table->string('seo_keywords')->nullable();
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
        Schema::dropIfExists('blogs');
    }
};
