<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreditHistory extends Model
{
    protected $table = 'credit_histories';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'subscription_id',
        'total_credits',
        'remaining_credits',
        'status',
        'expiry_date',
        'purchase_date',
    ];

    public function subscription(){
        return $this->belongsTo(Subscription::class);
    }

}
