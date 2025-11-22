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
            $table->string('name')->nullable()->after('user_id');
            $table->text('sample_text')->nullable()->after('name');
            $table->boolean('noise_reduction')->default(false)->after('sample_text');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('voice_clones', function (Blueprint $table) {
             $table->dropColumn(['name', 'sample_text', 'noise_reduction']);
        });
    }
};
