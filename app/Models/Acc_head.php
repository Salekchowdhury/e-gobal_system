<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acc_head extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'head_title',
        'create_date',
        
    ];
}