<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reward extends Model
{
    use HasFactory;
    protected $table = 'rewards';
    protected $fillable = [
        'description',
        'image_url',
        'avail_qty',
        'points_required',
        'status'
    ];
}
