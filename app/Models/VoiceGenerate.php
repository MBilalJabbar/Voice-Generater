<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VoiceGenerate extends Model
{
    protected $table = 'voice_generates';
    protected $primaryKey = 'id';
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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
