<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VoiceClone extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'sample_text',
        'language',
        'gender',
        'voice_id',
        'file_path',
        'noise_reduction',
    ];

}
