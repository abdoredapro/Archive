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
        Schema::table('files', function (Blueprint $table) {
            $table->char('hours')->after('info')->nullable();
            $table->char('minutes')->after('hours')->nullable();
            $table->char('seconds')->after('minutes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('files', function (Blueprint $table) {
            $table->dropColumn('hours');
            $table->dropColumn('minutes');
            $table->dropColumn('seconds');
        });
    }
};
