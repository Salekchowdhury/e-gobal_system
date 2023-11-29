<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCommissionDistribution;
use App\Models\{
    User, Products
};
use Auth;

class ProductCommissionDistributionController extends Controller
{
   public function index()
   {
    // dd('ff');
      $users = User::get();
      $products = Products::get();
    //   $productCommission = ProductCommissionDistribution::with(['product','user'])->orderBy('id','DESC')->get();
      $productCommission = ProductCommissionDistribution::with(['product','user'])->orderBy('id','DESC')->paginate(10);

    return view('Admin.commissionDistribution.index', compact('productCommission','users','products'));
   }

   public function commissionSearch(Request $request)
   {
    //   dd($request->all());

    $users = User::get();
    $products = Products::get();

    $from = $request->from_date;
    $to = $request->to_date;
    $user_id = $request->user_id;
    $product_id = $request->product_id;

    if(!$from && !$to && !$user_id && !$product_id){
        if(Auth::user()->type == 1){
            return $this->index();

        }else if(Auth::user()->type == 3){
            return $this->userCommissionDistribution();
        }
    }
    else if($from && $to && $user_id && $product_id){

        $productCommission = ProductCommissionDistribution::where('user_id',$user_id)->where('product_id',$product_id)
        ->whereBetween('created_at', [$request->from_date." 00:00:00", $request->to_date." 23:59:59"])
        ->orderBy('id','DESC')->get();
        return view('Admin.commissionDistribution.index', compact('productCommission','users','products'));
    }
    else if($from && $to && $user_id && !$product_id){

        $productCommission = ProductCommissionDistribution::where('user_id',$user_id)
        ->with(['product'])->whereBetween('created_at', [$request->from_date." 00:00:00", $request->to_date." 23:59:59"])
        ->orderBy('id','DESC')->get();
        return view('Admin.commissionDistribution.index', compact('productCommission','users','products'));
    }
    else if($from && $to && !$user_id && $product_id){

        if(Auth::user()->type == 1){
            $productCommission = ProductCommissionDistribution::where('product_id',$product_id)
            ->with(['user'])->whereBetween('created_at', [$request->from_date." 00:00:00", $request->to_date." 23:59:59"])
            ->orderBy('id','DESC')->get();
            return view('Admin.commissionDistribution.index', compact('productCommission','users','products'));
        }
        else if(Auth::user()->type == 3){
            $productCommission = ProductCommissionDistribution::where('product_id',$product_id)
            ->where('user_id',Auth::user()->id)
            ->with(['user'])->whereBetween('created_at', [$request->from_date." 00:00:00", $request->to_date." 23:59:59"])
            ->orderBy('id','DESC')->get();
            return view('Admin.commissionDistribution.user-commission-distribution', compact('productCommission','products'));
            }

    }
    else if($from && $to && !$user_id && !$product_id){


        if(Auth::user()->type == 1){

            $productCommission = ProductCommissionDistribution::whereBetween('created_at', [$request->from_date." 00:00:00", $request->to_date." 23:59:59"])
            ->with(['product','user'])->orderBy('id','DESC')->get();
            return view('Admin.commissionDistribution.index', compact('productCommission','users','products'));
        }
        else if(Auth::user()->type == 3){


            $productCommission = ProductCommissionDistribution::where('user_id',Auth::user()->id)
            ->whereBetween('created_at', [$request->from_date." 00:00:00", $request->to_date." 23:59:59"])
            ->with(['product','user'])->orderBy('id','DESC')->get();
            return view('Admin.commissionDistribution.user-commission-distribution', compact('productCommission','products'));
            }

    }
    else if(!$from && !$to && $user_id && $product_id){

        $productCommission = ProductCommissionDistribution::where('user_id',$user_id)->where('product_id',$product_id)
        ->with(['product','user'])->orderBy('id','DESC')->get();
        return view('Admin.commissionDistribution.index', compact('productCommission','users','products'));
    }
    else if(!$from && !$to && !$user_id && $product_id){


        if(Auth::user()->type == 1){

            $productCommission = ProductCommissionDistribution::where('product_id',$product_id)
            ->with(['user'])->orderBy('id','DESC')->get();
            return view('Admin.commissionDistribution.index', compact('productCommission','users','products'));
        }
        else if(Auth::user()->type == 3){

            $productCommission = ProductCommissionDistribution::where('user_id',Auth::user()->id)
            ->where('product_id',$product_id)
            ->with(['user'])->orderBy('id','DESC')->get();
            return view('Admin.commissionDistribution.user-commission-distribution', compact('productCommission','products'));

            }



    }
    else if(!$from && !$to && $user_id && !$product_id){
        $productCommission = ProductCommissionDistribution::where('user_id',$user_id)
        ->with(['product','user'])->orderBy('id','DESC')->get();
        return view('Admin.commissionDistribution.index', compact('productCommission','users','products'));
    }



   }

   public function userCommissionDistribution()
   {
    $id =\Auth::user()->id;
    $products = Products::get();
    // dd($id);
    $productCommission = ProductCommissionDistribution::where('user_id',$id)->with(['product','user'])->orderBy('id','DESC')->get();
    //  dd($productCommission);
    return view('Admin.commissionDistribution.user-commission-distribution',compact('productCommission','products'));
    // return 'userCommissionDistribution rr  $id' $id;
    // dd($id);
   }
}