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
        Schema::create('usertemplate', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('campaign_id');          
            $table->integer('occasion_id');   
            $table->text('template_name');
            $table->text('template_data');
            $table->text('gradient_background');
            $table->text('thumb');
            $table->tinyInteger('save_as_template');
            $table->dateTime('datetime');
            $table->dateTime('modifydate');
            $table->tinyInteger('status');
            $table->tinyInteger('access_level');
            $table->integer('template_access_leavel');
            $table->string('template_custom_size');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usertemplate');
    }
};
