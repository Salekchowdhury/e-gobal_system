<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $fillable = [
        'vendor_id','cat_id','admin_product_price','subcat_id','innersubcat_id','product_name','brand','description','tags','old_price','product_price','discounted_price','slug','is_variation','attribute','status','is_hot','free_shipping','flat_rate','shipping_cost','is_return','return_days','is_featured','available_stock','est_shipping_days','tax','tax_type','sku','product_qty','product_type'
    ];

    public function category(){
        return $this->hasOne('App\Models\Category','id','cat_id');
    }

    public function subcategory(){
        return $this->hasOne('App\Models\Subcategory','id','subcat_id');
    }

    public function innersubcategory(){
        return $this->hasOne('App\Models\Innersubcategory','id','innersubcat_id');
    }

    public function productimage(){
        return $this->hasOne('App\Models\ProductImages','product_id','id')->select('id','product_id',\DB::raw("CONCAT('".url('/storage/app/public/images/products/')."/', image) AS image_url"));
    }

    public function variation(){
        return $this->hasOne('App\Models\Variation','product_id','id')->select('id','product_id','price','discounted_variation_price','variation','qty');
    }

    public function productimages(){
        return $this->hasMany('App\Models\ProductImages','product_id','id')->select('id','product_id','image as image_name',\DB::raw("CONCAT('".url('/storage/app/public/images/products/')."/', image) AS image_url"));
    }

    public function variations(){
        return $this->hasMany('App\Models\Variation','product_id','id')->select('id','product_id','price','discounted_variation_price','variation','qty');
    }

    public function rattings(){
        return $this->hasMany('App\Models\Ratting','product_id','id')->select('product_id',\DB::raw('ROUND(AVG(ratting),1) as avg_ratting'))->groupBy('product_id');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\Ratting','product_id','id')->with('users');
    }

    public function product()
    {
        return $this->hasMany('App\Models\VendorProduct','product_id','id')->with(['productimage','variations','reviews','rattings']);
    }

    public function user(){
        return $this->belongsTo(User::class,'vendor_id');
    }

    // public function rattingUser(){
    //     return $this->belongsTo(User::class,'vendor_id');
    // }
}