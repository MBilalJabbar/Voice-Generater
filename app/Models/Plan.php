<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
     protected $fillable = [
        'name', 'price', 'currency', 'duration', 'expires',
        'characters', 'minutes',
        'text_to_speech', 'bulk_voice_generation', 'voice_cloning', 'voice_effects',
        'ultra_hd_audio', 'all_voices_models', 'priority_usage', 'faster_processing',
        'team_studio_usage', 'premium_support', 'extended_usage'
    ];
}
