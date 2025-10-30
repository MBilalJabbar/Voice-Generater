<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VoicesModel extends Model
{
    protected $table = 'voices';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'title',
        'audio_path',
        'note',
    ];
}
