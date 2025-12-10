<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactSupport extends Model
{
    protected $table = 'contact_supports';

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'message',
    ];
}
