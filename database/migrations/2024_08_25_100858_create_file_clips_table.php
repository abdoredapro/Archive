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
        Schema::create('file_clips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('file_id')
            ->constrained('files')
            ->cascadeOnDelete();

            $table->string('name');
            $table->string('clip');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_clips');
    }
};
