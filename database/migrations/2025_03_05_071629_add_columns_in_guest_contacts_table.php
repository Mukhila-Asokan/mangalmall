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
        Schema::table('guest_contacts', function (Blueprint $table) {
            $table->dropColumn('company');
            $table->dropColumn('designation');
            $table->string('relationship')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('guest_contacts', function (Blueprint $table) {
            $table->dropColumn('relationship');
        });
    }
};
