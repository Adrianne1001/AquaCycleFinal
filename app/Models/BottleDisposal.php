<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BottleDisposal extends Model
{
    use HasFactory;
    protected $table = 'bottle_disposals';
    protected $fillable = [
        'user_id',
        'points_received',
        'bottles_qty',
        'small_qty',
        'med_qty',
        'large_qty',
        'xl_qty',
        'xxl_qty',
        'disposal_date',
        'trashbag_fill_status'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
