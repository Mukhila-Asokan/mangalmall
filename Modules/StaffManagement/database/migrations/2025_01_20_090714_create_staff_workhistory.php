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
        Schema::create('staff_workhistory', function (Blueprint $table) {
            $table->id();
            $table->integer('staff_id');
            $table->string('employeername');
            $table->string('desgination');
            $table->date('start_date');
            $table->date('end_date');
            $table->text('leavereason');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff_workhistory');
    }
};
