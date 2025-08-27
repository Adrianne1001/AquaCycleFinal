<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserStats extends Model
{
    use HasFactory;
    protected $table = 'user_stats';
    protected $fillable = [
        'user_id',
        'outstanding_points',
        'total_accu_points',
        'total_bottles_thrown'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
