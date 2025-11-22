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
        Schema::table('voice_clones', function (Blueprint $table) {
            $table->enum('status', ['pending', 'ready', 'failed'])->default('pending')->after('noise_reduction');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('voice_clones', function (Blueprint $table) {
           $table->dropColumn('status');
        });
    }
};
