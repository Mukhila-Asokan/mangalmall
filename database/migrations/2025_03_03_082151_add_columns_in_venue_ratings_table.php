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
        Schema::table('venue_ratings', function (Blueprint $table) {
            $table->timestamp('verified_at')->nullable();
            $table->text('rejected_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('venue_ratings', function (Blueprint $table) {
            $table->dropColumn('verified_at');
            $table->dropColumn('rejected_reason');
        });
    }
};
