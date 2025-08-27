<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RewardExchange extends Model
{
    use HasFactory;
    protected $table = 'reward_exchanges';
    protected $fillable = [
        'user_id',
        'reward_id',
        'qty',
        'status'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function reward()
    {
        return $this->belongsTo(reward::class, 'reward_id');
    }
}
