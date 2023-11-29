<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorProduct extends Model
{
    use HasFactory;
    protected $fillable =[
        'product_id',
        'vendor_id',
        'cat_id',
        'subcat_id',
        'innersubcat_id',
        'product_name',
        'brand',
        'description',
        'tag',
        'product_price',
        'discounted_price',
        'product_qty',
        'slug',
        'is_variation',
        'status',
        'approve_status',
        'is_hot',
        'free_shipping',
        'flat_rate',
        'shipping_cost',
        'is_return',
        'return_days',
        'is_featured',
        'available_stock',
        'est_shipping_days',
        'sku',
        'point',
        'tax',
        'tax_type',
        'product_type',
        'admin_product_price',
    ];

    // public function categorys(){
    //     return $this->hasOne('App\Models\Category','id','cat_id');
    // }

    public function subcategory(){
        return $this->hasOne('App\Models\Subcategory','id','subcat_id');
    }

    public function innersubcategory(){
        return $this->hasOne('App\Models\Innersubcategory','id','innersubcat_id');
    }

    public function productimage(){
        return $this->hasOne('App\Models\ProductImages','vendor_product_id','id')->select('id','vendor_product_id',\DB::raw("CONCAT('".url('/storage/app/public/images/products/')."/', image) AS image_url"));
    }

    public function variation(){
        return $this->hasOne('App\Models\Variation','vendor_product_id','id')->select('id','vendor_product_id','price','discounted_variation_price','variation','qty');
    }

    public function productimages(){
        return $this->hasMany('App\Models\ProductImages','vendor_product_id','id')->select('id','vendor_product_id','image as image_name',\DB::raw("CONCAT('".url('/storage/app/public/images/products/')."/', image) AS image_url"));
    }

    public function variations(){
        return $this->hasMany('App\Models\Variation','vendor_product_id','id')->select('id','vendor_product_id','price','discounted_variation_price','variation','qty');
    }

    public function rattings(){
        return $this->hasMany('App\Models\Ratting','vendor_product_id','id')->select('vendor_product_id',\DB::raw('ROUND(AVG(ratting),1) as avg_ratting'))->groupBy('vendor_product_id');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\Ratting','vendor_product_id','id');
    }

    // public function productRattings()
    // {
    //     return $this->hasMany(Ratting::class, 'product_id','product_id');
    // }

    public function products()
    {
        return $this->belongsTo(Products::class, 'product_id')->with(['productimage','variations','reviews']);
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }
}