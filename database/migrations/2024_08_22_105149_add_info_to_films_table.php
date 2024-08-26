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
        Schema::table('films', function (Blueprint $table) {
            $table->string('release_year')->nullable();
            $table->string('tap_type')->nullable();
            $table->string('production_manager')->nullable();
            $table->integer('tap_number')->nullable();
            $table->string('project_beneficiary')->nullable();
            $table->string('sound_engineer')->nullable();
            $table->string('project_category')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('films', function (Blueprint $table) {
            $table->dropColumn('release_year');
            $table->dropColumn('tap_type');
            $table->dropColumn('production_manager');
            $table->dropColumn('tap_number');
            $table->dropColumn('project_beneficiary');
            $table->dropColumn('sound_engineer');
            $table->dropColumn('project_category');
        });
    }
};
