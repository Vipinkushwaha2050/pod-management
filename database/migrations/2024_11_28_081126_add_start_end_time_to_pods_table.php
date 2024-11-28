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
        Schema::table('pods', function (Blueprint $table) {
            $table->dateTime('start_time')->nullable(); // Adding start_time
            $table->dateTime('end_time')->nullable();   // Adding end_time
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pods', function (Blueprint $table) {
            //
        });
    }
};
