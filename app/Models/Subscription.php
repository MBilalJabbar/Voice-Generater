<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $table = 'subscriptions';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id', 'plan_id', 'payment_method', 'amount', 'currency', 'start_date', 'end_date', 'status'
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function creditHistories(){
        return $this->hasMany(CreditHistory::class, 'subscription_id', 'id');
    }

    // Relationship to get the latest credit history
    public function latestCredit(){
        return $this->hasOne(CreditHistory::class, 'subscription_id', 'id')->latest('created_at');
    }

}
