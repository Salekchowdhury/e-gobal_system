<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AchieveIncentive extends Model
{
    use HasFactory;
    protected $fillable = [
      'user_id',
      'incentive_id',
      'title',
      'name',
      'achieve_date',
    ];

    public function user()
    {
        return $this->belongsTo(user::class, 'user_id');
    }
}