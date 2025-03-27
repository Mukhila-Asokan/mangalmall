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
        Schema::create('usercampaings', function (Blueprint $table) {
            $table->id();
            $table->integer('userid');
            $table->integer('occasion_id');
            $table->date('validupto');                         
            $table->integer('theme_id');
            $table->string('themename');            
            $table->longtext('custom_css');            
            $table->longtext('custom_js');            
            $table->longtext('template_html');            
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
        Schema::dropIfExists('usercampaings');
    }
};
