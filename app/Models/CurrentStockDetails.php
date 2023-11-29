<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrentStockDetails extends Model
{
    use HasFactory;
    protected $fillable =[
        'user_id',
        'stock_id',
        'product_id',
        'qty',
        'transaction_type',
    ];
}