<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductWiseIncome extends Model
{
    use HasFactory;

    protected $fillable = [
         'product_id',
         'vendor_product_id',
         'vendor_id',
         'order_id',
         'order_number',
         'invoice_id',
         'product_price',
         'admin_product_price',
         'delivery_charge',
         'vendor_profit',
         'admin_profit',
         'qty',
         'generated_date',
         'distribute_amount',
    ];

    public function vendor(){
        return $this->belongsTo(User::class,'vendor_id');
    }

    public function product(){

        return $this->belongsTo(VendorProduct::class,'vendor_product_id');
    }
}