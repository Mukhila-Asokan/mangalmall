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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('first_name'); 
            $table->string('last_name'); 
            $table->text('staff_photo'); 
            $table->string('email'); 
            $table->string('phone'); 
            $table->date('date_of_birth'); 
            $table->date('hire_date');          
            $table->string('employee_code'); 
            $table->tinyInteger('roleid'); 
            $table->tinyInteger('departmentid');          
            $table->tinyInteger('supervisor_id');          
            $table->enum('status',['Active', 'Inactive','Onleave'])->default('Active'); 
            $table->tinyInteger('delete_status')->default('0');   
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
