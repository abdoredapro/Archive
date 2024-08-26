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
            $table->string('hour')->nullable();
            $table->string('minute')->nullable();
            $table->string('second')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('file_clips', function (Blueprint $table) {
            $table->dropColumn('hour');
            $table->dropColumn('minute');
            $table->dropColumn('second');
        });
    }
};
