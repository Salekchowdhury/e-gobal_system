<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCommissionDistribution extends Model
{
    use HasFactory;
    protected $table = 'product_commission_distributions';
    protected $fillable = [
        'vendor_id',
        'level',
        'product_id',
        'point',
        'amount',
        'generated_date',
        'approved_id',
        'order_id',
        'user_id',
    ];

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}