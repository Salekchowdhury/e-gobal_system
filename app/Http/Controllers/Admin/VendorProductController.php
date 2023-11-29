<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VendorProduct;

class VendorProductController extends Controller
{
    public function index()
    {
    //   $product_vendors = VendorProduct::with(['products','user','category'])->orderBy('id','DESC')->paginate(5);
      $product_vendors = VendorProduct::with('products')->get();
    //   dd($product_vendors);

     return view('Admin.productVedor.index',compact('product_vendors'));
    }
}