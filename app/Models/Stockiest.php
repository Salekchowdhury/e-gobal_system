<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stockiest extends Model
{
    use HasFactory;
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function currentStock()
    {
        return $this->hasMany(CurrentStock::class, 'stock_id')->with('product');
    }

    public function order()
    {
     return $this->hasMany(Order::class, 'stockiest_id', 'id');
    }
    
    // public function product()
    // {
    //     return $this->belongsTo(Products::class, 'product_id');
    // }
    public function scopeWhereDateBetween($query, $fieldName, $fromDate, $todate)
    {
        return $query->whereDate($fieldName,'>=',$fromDate)->whereDate($fieldName,'<=',$todate);

        // SELECT * FROM `orders` WHERE `created_at` between '2023-03-13' AND '2023-03-15';
    }
}