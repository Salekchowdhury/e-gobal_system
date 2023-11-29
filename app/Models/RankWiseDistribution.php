<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RankWiseDistribution extends Model
{
    use HasFactory;
    protected $fillable = [
        'generate_date', 'rank', 'user_id', 'amount',
    ];
    public function user()
    {
        return $this->belongsTo(user::class, 'user_id');
    }
}