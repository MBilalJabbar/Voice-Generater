<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BulkVoices extends Model
{
    protected $table = 'bulk_voices';

    protected $fillable = [
        'user_id',
        'voice_name',
        'status',
        'text',
        'language',
        'model',
        'voice_settings',
        'api_voice_id',
        'audio_path',
        'started_time',
        'completed_time',
        'duration',
    ];
}
