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
        Schema::create('muhurtham_dates', function (Blueprint $table) {
            $table->id();
            $table->date('muhurtham_date')->nullable();
            $table->integer('muhurtham_year')->nullable();
            $table->integer('muhurtham_month')->nullable();
            $table->string('muhurtham_type')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('muhurtham_dates');
    }
};
