<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskHistory extends Model
{
    protected $table = 'task_histories';

    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'voice_id',
        'voice_name',
        'text',
        'language',
        'model',
        'voice_settings',
        'audio_path',
        'deleted_at',
    ];
}
