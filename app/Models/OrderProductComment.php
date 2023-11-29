<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProductComment extends Model
{
    use HasFactory;
    protected $fillable = [
       'order_id',
       'comment',
       'status',
       'generate_date',
    ];


}