<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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


    public function getStatusAttribute($value)
    {
        if ($this->expiry_date && Carbon::now()->gt($this->expiry_date)) {
            return 'expired';
        }

        return $value;
    }

}
