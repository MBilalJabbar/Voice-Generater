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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price', 10, 2)->default(0);
            $table->string('currency')->default('$');
            $table->string('duration')->default('30')->nullable();
            $table->date('expires')->nullable();

            // Usage limits
            $table->integer('characters')->nullable();
            $table->integer('minutes')->nullable();

            // Feature toggles
            $table->boolean('text_to_speech')->default(1);
            $table->boolean('bulk_voice_generation')->default(0);
            $table->boolean('voice_cloning')->default(0);
            $table->boolean('voice_effects')->default(0);
            $table->boolean('ultra_hd_audio')->default(0);
            $table->boolean('all_voices_models')->default(0);
            $table->boolean('priority_usage')->default(0);
            $table->boolean('faster_processing')->default(0);
            $table->boolean('team_studio_usage')->default(0);
            $table->boolean('premium_support')->default(0);
            $table->boolean('extended_usage')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
