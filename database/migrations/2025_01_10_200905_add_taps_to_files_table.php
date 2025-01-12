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
            $table->string('image')->nullable()->change();
            $table->string('director')->nullable();
            $table->string('producer')->nullable();
            $table->string('music')->nullable();
            $table->string('sound')->nullable();
            $table->string('camera_man')->nullable();
            $table->string('editor')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('files', function (Blueprint $table) {
            $table->dropColumn('director');
            $table->dropColumn('producer');
            $table->dropColumn('music');
            $table->dropColumn('sound');
            $table->dropColumn('camera_man');
            $table->dropColumn('editor');
            $table->dropColumn('writer');
        });
    }
};
