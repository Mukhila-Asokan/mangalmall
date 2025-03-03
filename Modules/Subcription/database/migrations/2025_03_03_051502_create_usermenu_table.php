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
        Schema::create('usermenu', function (Blueprint $table) {
            $table->id();
            $table->string('menuname');
            $table->string('icon');
            $table->tinyInteger('parentid');
            $table->tinyInteger('sortorder');
            $table->enum('status', ['active', 'inactive'])->default('active'); // Plan status
            $table->tinyInteger('delete_status')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usermenu');
    }
};
