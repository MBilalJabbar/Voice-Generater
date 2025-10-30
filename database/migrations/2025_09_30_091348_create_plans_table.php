<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->decimal('price', 12, 2)->nullable();
            $table->integer('duration')->nullable();
            $table->bigInteger('characters')->nullable();
            $table->integer('minutes')->nullable();
            $table->boolean('text_to_speech')->nullable();
            $table->boolean('bulk_voice_generation')->nullable();
            $table->boolean('voice_cloning')->nullable();
            $table->boolean('voice_effects')->nullable();
            $table->boolean('ultra_hd_audio')->nullable();
            $table->boolean('all_voices_models')->nullable();
            $table->boolean('priority_usage')->nullable();
            $table->boolean('faster_processing')->nullable();
            $table->boolean('team_studio_usage')->nullable();
            $table->boolean('premium_support')->nullable();
            $table->boolean('extended_usage')->nullable();
            $table->date('expires')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
