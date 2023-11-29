<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RankingEarning extends Model
{
    use HasFactory;
    protected $fillable =[
         'product_id','vendor_product_id','vendor_id','order_id','rankin_type','order_number','amount','generated_date',
    ];
}