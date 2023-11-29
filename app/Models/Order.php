<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'product_id','vendor_id','order_number','product_name','image','qty','price','variation','tax','shipping_cost','order_total','stockiest_id','order_notes','payment_type','full_name','email','mobile','landmark','street_address','pincode','vendor_product_id','admin_product_price','assigned_at','product_type'
    ];

    public function vendors(){
        return $this->hasOne('App\Models\User','id','vendor_id')->select('id','name','store_address','referral_code','refferal_vendor',\DB::raw("CONCAT('".url('/storage/app/public/images/profile/')."/', profile_pic) AS image_url"));
    }

    public function stockiest()
    {
     return $this->belongsTo(Stockiest::class, 'stockiest_id');
    }
    public function stockiests()
    {
     return $this->belongsToMany(Stockiest::class, 'stockiest_id');
    }

    public function user()
    {
     return $this->belongsTo(User::class, 'user_id');
    }

     public function product()
     {
     return $this->belongsTo(Products::class, 'product_id');
    }

     public function orderComment()
     {
     return $this->hasMany(OrderProductComment::class, 'order_id');
    }

    public function scopeWhereDateBetween($query, $fieldName, $fromDate, $todate)
    {
        return $query->whereDate($fieldName,'>=',$fromDate)->whereDate($fieldName,'<=',$todate);

        // SELECT * FROM `orders` WHERE `created_at` between '2023-03-13' AND '2023-03-15';
    }
}