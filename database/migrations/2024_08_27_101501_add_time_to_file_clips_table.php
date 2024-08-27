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
        Schema::table('file_clips', function (Blueprint $table) {
            $table->string('minutes_time');
            $table->string('second_time');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('file_clips', function (Blueprint $table) {
            $table->dropColumn('minutes_time');
            $table->dropColumn('second_time');
        });
    }
};
