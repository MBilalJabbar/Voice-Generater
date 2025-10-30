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
        Schema::create('voice_generates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('voice_name')->nullable();
            $table->string('status')->default('pending');
            $table->longText('text')->nullable();
            $table->string('language')->default('en-US');
            $table->string('model')->nullable();
            $table->json('voice_settings')->nullable();
            $table->string('api_voice_id')->nullable();
            $table->string('audio_path')->nullable();
            $table->timestamp('started_time')->nullable();
            $table->timestamp('completed_time')->nullable();
            $table->integer('duration')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voices');
    }
};
