<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Products;
use App\Models\Slider;
use App\Models\VendorProduct;
use Auth;
use DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /*
    public function index(Request $request)
    {
        $user_id  = @Auth::user()->id;
        $sliders=Slider::select('link','image')->get();
        $banners=Banner::select('id','type','cat_id','product_id','positions','image')->get();
        $brands=Brand::select('id','icon')->get();
        $vendors=User::select('id','name','profile_pic')->where('type','3')->where('is_available','1')->get();


        $featured_products=Products::with(['productimage','variation','reviews'])
        ->select('products.id','products.product_name','products.product_price','products.slug','products.discounted_price','products.is_variation','products.is_hot','products.sku',\DB::raw('(case when wishlists.product_id is null then 0 else 1 end) as is_wishlist'),DB::raw('ROUND(AVG(rattings.ratting),1) as ratings_average'))
        ->leftJoin('wishlists', function($query) use($user_id) {
            $query->on('wishlists.product_id','=','products.id')
            ->where('wishlists.user_id', '=', $user_id);
        })
        ->join('users','products.vendor_id','=','users.id')
        ->leftJoin('rattings', 'rattings.product_id', '=', 'products.id')
        ->groupBy('products.id')
        ->where('users.is_available','1')
        ->where('products.is_featured','1')
        ->where('products.status','1')
        ->inRandomOrder()->limit(12)->get();

        $hot_products=Products::with(['productimage','variation','reviews'])
        ->select('products.id','products.product_name','products.product_price','products.slug','products.discounted_price','products.is_variation','products.is_hot','products.sku',\DB::raw('(case when wishlists.product_id is null then 0 else 1 end) as is_wishlist'),DB::raw('ROUND(AVG(rattings.ratting),1) as ratings_average'))
        ->leftJoin('wishlists', function($query) use($user_id) {
            $query->on('wishlists.product_id','=','products.id')
            ->where('wishlists.user_id', '=', $user_id);
        })
        ->join('users','products.vendor_id','=','users.id')
        ->leftJoin('rattings', 'rattings.product_id', '=', 'products.id')
        ->groupBy('products.id')
        ->where('products.is_hot','1')
        ->where('products.status','1')
        ->inRandomOrder()->limit(12)->get();

        $new_products=Products::with(['productimage','variation','reviews'])
        ->select('products.id','products.product_name','products.product_price','products.slug','products.discounted_price','products.is_variation','products.is_hot','products.sku',\DB::raw('(case when wishlists.product_id is null then 0 else 1 end) as is_wishlist'),DB::raw('ROUND(AVG(rattings.ratting),1) as ratings_average'))
        ->leftJoin('wishlists', function($query) use($user_id) {
            $query->on('wishlists.product_id','=','products.id')
            ->where('wishlists.user_id', '=', $user_id);
        })
        ->join('users','products.vendor_id','=','users.id')
        ->leftJoin('rattings', 'rattings.product_id', '=', 'products.id')
        ->groupBy('products.id')
        ->where('users.is_available','1')
        ->where('products.status','1')
        ->orderBy('products.id', 'DESC')
        ->get()->take(12);

        return view('Front.home',compact('vendors','banners','featured_products','brands','hot_products','sliders','new_products'));
    }
    */

    public function index(Request $request)
    {
        // dd('ll');
        $user_id  = @Auth::user()->id;
        $sliders=Slider::select('link','image')->get();
        $banners=Banner::select('id','type','cat_id','product_id','positions','image')->get();
        $brands=Brand::select('id','icon')->get();
        $vendors=User::select('id','name','profile_pic')->where('type','3')->where('is_available','1')->get();


//         $featured_products=VendorProduct::with(['products','user'])->get();
//         dd($featured_products);
// /*
//         ->select('vendor_products.products.id','products.product_name','products.product_price','products.slug','products.discounted_price','products.is_variation','products.is_hot','products.sku',\DB::raw('(case when wishlists.product_id is null then 0 else 1 end) as is_wishlist'),DB::raw('ROUND(AVG(rattings.ratting),1) as ratings_average'))
//         ->leftJoin('wishlists', function($query) use($user_id) {
//             $query->on('wishlists.product_id','=','products.id')
//             ->where('wishlists.user_id', '=', $user_id);
//         })
//         // ->join('users','products.vendor_id','=','users.id')
//         // ->leftJoin('rattings', 'rattings.product_id', '=', 'products.id')
//         // ->groupBy('products.id')
//         ->where('users.is_available','1')
//         ->where('products.is_featured','1')
//         ->where('products.status','1')
//         ->inRandomOrder()->limit(12)->get();
// */

    $featured_products = VendorProduct::with(['productimage','variation','reviews'])
        ->select('vendor_products.id','vendor_products.product_name','vendor_products.product_price','vendor_products.slug','vendor_products.discounted_price','vendor_products.is_variation','vendor_products.is_hot','vendor_products.sku',\DB::raw('(case when wishlists.product_id is null then 0 else 1 end) as is_wishlist'),DB::raw('ROUND(AVG(rattings.ratting),1) as ratings_average'))
        ->leftJoin('wishlists', function($query) use($user_id) {
            $query->on('wishlists.product_id','=','vendor_products.id')
            ->where('wishlists.user_id', '=', $user_id);
        })
        ->join('users','vendor_products.vendor_id','=','users.id')
        ->leftJoin('rattings', 'rattings.product_id', '=', 'vendor_products.id')
        ->groupBy('vendor_products.id')
        ->where('users.is_available','1')
        ->where('vendor_products.is_featured','1')
        ->where('vendor_products.approve_status','1')
        ->where('vendor_products.status','1')
        ->inRandomOrder()->limit(12)->get();


        $hot_products = VendorProduct::with(['productimage','variation','reviews'])
        ->select('vendor_products.id','vendor_products.product_name','vendor_products.product_price','vendor_products.slug','vendor_products.discounted_price','vendor_products.is_variation','vendor_products.is_hot','vendor_products.sku',\DB::raw('(case when wishlists.product_id is null then 0 else 1 end) as is_wishlist'),DB::raw('ROUND(AVG(rattings.ratting),1) as ratings_average'))
        ->leftJoin('wishlists', function($query) use($user_id) {
            $query->on('wishlists.product_id','=','vendor_products.id')
            ->where('wishlists.user_id', '=', $user_id);
        })
        ->join('users','vendor_products.vendor_id','=','users.id')
        ->leftJoin('rattings', 'rattings.product_id', '=', 'vendor_products.id')
        ->groupBy('vendor_products.id')
        ->where('vendor_products.is_hot','1')
        ->where('vendor_products.status','1')
        ->where('vendor_products.approve_status','1')
        ->inRandomOrder()->limit(12)->get();

        $new_products = VendorProduct::with(['productimage','variation','reviews'])
        ->select('vendor_products.id','vendor_products.product_name','vendor_products.product_price','vendor_products.slug','vendor_products.discounted_price','vendor_products.is_variation','vendor_products.is_hot','vendor_products.sku',\DB::raw('(case when wishlists.product_id is null then 0 else 1 end) as is_wishlist'),DB::raw('ROUND(AVG(rattings.ratting),1) as ratings_average'))
        ->leftJoin('wishlists', function($query) use($user_id) {
            $query->on('wishlists.product_id','=','vendor_products.id')
            ->where('wishlists.user_id', '=', $user_id);
        })
        ->join('users','vendor_products.vendor_id','=','users.id')
        ->leftJoin('rattings', 'rattings.product_id', '=', 'vendor_products.id')
        ->groupBy('vendor_products.id')
        ->where('users.is_available','1')
        ->where('vendor_products.status','1')
        ->where('vendor_products.approve_status','1')
        ->orderBy('vendor_products.id', 'DESC')
        ->get()->take(12);
        // dd($featured_products,$new_products,$hot_products);

        return view('Front.home',compact('vendors','banners','featured_products','brands','hot_products','sliders','new_products'));
    }

}