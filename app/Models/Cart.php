<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id', 'product_id','vendor_id','product_name','image','qty','price','variation','attribute','shipping_cost','tax','point','slug','vendor_product_id','admin_product_price','product_type'
    ];

    public function vendor() {
        return $this->belongsTo(User::class, 'vendor_id');
    }
}