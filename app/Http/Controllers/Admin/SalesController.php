<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Purchase;
use App\Models\User;
use App\Models\Stockiest;
use App\Models\CurrentStockDetails;
use App\Models\CurrentStock;
use App\VSE;
class SalesController extends Controller
{
    public function create()
    {
      $products = Products::all();
     return view('Admin.sales.create_new', compact('products'));
    }
    // public function store(Request $request)

    // {

    //     $data = count($request->all());


    //   $sum = 0;
    //   $count =1;
    //   $newArray = [];
    //   $lastArray = [];

    //  foreach($request->all() as $items){
    //      $arrayData = $items;
    //      $finalItemarray = array_pop($arrayData);

    //   }
    //     $lastArrayData = end($arrayData);


        //  $purchase = Purchase::create([
        //    'amount'=> $finalItemarray['amount'],
        //    'sub_total'=> $finalItemarray['sub_total'],
        //    'user_id'=> $finalItemarray['user_id'],
        //    'invoice_id'=> $finalItemarray['Invoice_no'],
        //    'due_date'=> $finalItemarray['due_date'],
        //    'tax'=> $finalItemarray['tax'],
        //    'vat'=> $finalItemarray['vat'],
        //    'load_unload'=> $finalItemarray['load_unload'],
        //    'note'=> $finalItemarray['note'],
        //    'card_phone_number'=> $finalItemarray['cardPhoneNumber'],
        //    'payment_by'=> $finalItemarray['paymentBy'],
        //    'method'=> $finalItemarray['method'],
        //    'discount'=> $finalItemarray['discount'],
        //  ]);

         // dd($purchase);
        //  foreach($arrayData as $value){
        //     $purchaseDetails = $purchase->purchaseDetails()->create([
        //          'purchase_id'=> $purchase->id,
        //          'product_id'=> $value['productId'],
        //          'qty'=> $value['qty'],
        //          'price'=> $value['price'],
        //      ]);

        //      $CurrentStockDetails = CurrentStockDetails::create([
        //        'user_id'=>$finalItemarray['user_id'],
        //        'stock_id'=>$finalItemarray['stock_id'],
        //        'product_id'=>$value['productId'],
        //        'qty'=>$value['qty'],
        //      ]);

        //      $stockData = CurrentStock::where('user_id',$finalItemarray['user_id'] )
        //      ->where('stock_id',$finalItemarray['stock_id'])
        //      ->where('product_id', $value['productId'])->first();

        //      if($stockData){
        //          $previousQty = $stockData->current_stock;
        //          $stockData->update([
        //                'current_stock'=> $previousQty+$value['qty'],
        //          ]);


        //      }else{
        //          CurrentStock::create([
        //              'user_id'=>$finalItemarray['user_id'],
        //              'stock_id'=>$finalItemarray['stock_id'],
        //              'product_id'=>$value['productId'],
        //              'current_stock'=>$value['qty'],
        //            ]);
        //      }
        //  }


        //  if($purchase && $purchaseDetails && $CurrentStockDetails){
        //      return response()->json([
        //          'status'=> 200,
        //          'message'=> 'Insert data successfully ',

        //      ]);
        //      }else{
        //          return response()->json([
        //              'status'=> 501,
        //              'message'=> 'something wrong',

        //          ]);
        //      }

    // }
   public function store(Request $request)

    {

        //  dd($request->all());
            $number = '';
            if(!empty($request->card)){

                $number = $request->card;

            }else if(!empty($request->bkash)){

                $number = $request->bkash;

            }else if(!empty($request->nagad)){

                $number = $request->nagad;

            }else if(!empty($request->rocket)){

                $number = $request->rocket;
            }

          $purchase = Purchase::create([
           'amount'=> $request->total_amount,
           'sub_total'=> $request->sub_total,
           'user_id'=> $request->user_id,
           'invoice_id'=> $request->InvoiceNo,
           'due_date'=> $request->due_date,
           'tax'=> $request->tax,
           'vat'=> $request->vat,
           'load_unload'=> $request->load_unload,
           'note'=> $request->note,
           'card_phone_number'=> $number,
           'payment_by'=> $request->payment_by,
           'method'=> $request->method,
           'discount'=> $request->discount,
         ]);

         $productLen = count($request->product_id);

         for($i=0; $i<$productLen ; $i++){
            $purchaseDetails = $purchase->purchaseDetails()->create([
                'purchase_id'=> $purchase->id,
                'product_id'=> $request->product_id[$i],
                'qty'=> $request->qty[$i],
                'price'=> $request->amount[$i],
            ]);

            $CurrentStockDetails = CurrentStockDetails::create([
                       'user_id'=> $request->user_id,
                       'stock_id'=>$request->stock_id,
                       'product_id'=> $request->product_id[$i],
                       'qty'=> $request->qty[$i],
                     ]);



             $stockData = CurrentStock::where('user_id',$request->user_id)
             ->where('stock_id', $request->stock_id)
             ->where('product_id', $request->product_id[$i])->first();

             if($stockData){
                 $previousQty = $stockData->current_stock;
                 $stockData->update([
                       'current_stock'=> $previousQty+$request->qty[$i],
                 ]);


             }else{
                 CurrentStock::create([

                       'user_id'=> $request->user_id,
                       'stock_id'=>$request->stock_id,
                       'product_id'=> $request->product_id[$i],
                       'current_stock'=> $request->qty[$i],
                   ]);
             }
         }

         if($purchase && $purchaseDetails && $CurrentStockDetails){
            $walletdata = User::select('cash_wallet')
            ->where('id', \Auth::user()->id)
            ->first();
            $walletamount = $walletdata->cash_wallet + $request->total_amount;
             User::where('id', \Auth::user()->id)->update(['cash_wallet' => $walletamount]);
            return redirect()->back()->with('success', 'Added Successfully');

             }else{
                return redirect()->back()->with('danger', 'something Wrong');
             }

    }


    public function ProductShow(Request $request)
    {
         $product = Products::findOrFail($request->id);
         return response()->json([
             'data'=>$product
         ]);

    }
     public function allProduct()
    {
         $product = Products::all();
         return response()->json([
             'status'=>200,
             'data'=>$product
         ]);

    }

     public function searchUser(Request $request)
    {
         if($request->ajax()){
             $searchData = Stockiest::wherehas("user",function($q) use($request){
                 $q->where('name','LIKE', $request->name.'%');
             })->with('user')->get();

             // dd($searchData);

             // $searchData = User::where('name','LIKE', $request->name.'%')->with('stockiest')->get();

             $output = '';

             if(count($searchData)> 0){
             $output = '<ul class="list-group" style="display:block; position:relative; z-index:1">';

                 foreach($searchData as $data){
                     $output .= '<li class="user-id list-group-item" value="'.$data->user_id.'"> '.$data->user->name.'</li>';
                 }

             $output .= '</ul>';
             }else{
                 $output .= '<li class="list-group-item"> No Data Found</li>';
             }

         }
     return $output;
 }

 public function showUser(Request $request)
 {
   if($request->ajax()){
     // $id = $request->user_id;

      $user = User::where('id',$request->user_id)->with('stockiest')->get();

      if($user){
         return response()->json([
             'status'=>200,
             'data'=>$user ,
          ]);
      }

   }
 }

        public function salesHistory()
        {

            $salesHistory = Purchase::with('user')->orderBy('id','DESC')->get();

            $users = Stockiest::get();

          return view('Admin.sales.history', compact('salesHistory','users'));
        }
        public function salesHistorySearch(Request $request)
        {
            // dd($request->all());
            $users = Stockiest::get();
            $from = $request->from_date;
            $to = $request->to_date;
            $user_id = $request->user_id;

            if(!$from && !$to && !$user_id){
                return $this->salesHistory();
            }

            if($user_id && !$from && !$to){
                $salesHistory = Purchase::where('user_id',$user_id)
                ->orderBy('id','DESC')
                ->get();
            }else if($user_id && $from && $to){
                $salesHistory = Purchase::where('user_id',$user_id)
                ->whereBetween('created_at', [$request->from_date." 00:00:00", $request->to_date." 23:59:59"])
                ->orderBy('id','DESC')
                ->get();
            }else{
                $salesHistory = Purchase::with('user')
                ->whereBetween('created_at', [$request->from_date." 00:00:00", $request->to_date." 23:59:59"])
                ->orderBy('id','DESC')
                ->get();
            }




          return view('Admin.sales.history', compact('salesHistory','users'));

        }

        public function salesStock()
        {
            $users = Stockiest::get();
            $stock_list = Stockiest::with('currentStock')->orderBy('id','DESC')->get();
            return view('Admin.sales.stockiest_stock', compact('stock_list','users'));

        }
          public function salesStockSearch(Request $request)
        {
            // dd($request->all());
            $user_id = $request->user_id;
            if($user_id){
                $users = Stockiest::get();
                $stock_list = Stockiest::where('user_id',$user_id)->with('currentStock')->orderBy('id','DESC')->get();
                return view('Admin.sales.stockiest_stock', compact('stock_list','users'));
            }else{

               return $this->salesStock();
            }


        }

        public function userSalesStock()
        {
            $id = \Auth::user()->id;
            // dd($id);
            $stock_list = Stockiest::where('user_id',$id)->with('currentStock')->get();
            // dd($stock_list);
            return view('Admin.sales.user_stockiest_stock', compact('stock_list'));

        }

}