<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesCommission extends Model
{
    use HasFactory;
    protected $fillable =[
        'stockiest_id',
        'product_id',
        'user_id',
        'point',
        'amount',
        'order_date',
        'approved_date',
        'generated_date',
    ];

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
     public function stockiest()
    {
        return $this->belongsTo(Stockiest::class, 'stockiest_id');
    }
    // public function product()
    // {
    //     return $this->belongsTo(Products::class, 'vendor_id');
    // }
    //  public function stockiest()
    // {
    //     return $this->belongsTo(Stockiest::class, 'user_id');
    // }
}