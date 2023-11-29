<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrentStock extends Model
{
    use HasFactory;
    protected $fillable =[
        'user_id',
        'stock_id',
        'product_id',
        'current_stock',
    ];

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }


}