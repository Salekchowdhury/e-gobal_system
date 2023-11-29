<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Stockiest;
use App\Models\Order;
use Auth;
class StockiestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Stockiest::orderBy('id', 'ASC')->get();
        // dd($data);
        return view('Admin.stockiest.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $users = User::where('type','=',3)->get();
    //    dd($users);
       return view('Admin.stockiest.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'user_id' => 'required',
            'stock_name' => 'required',
            'address' => 'required',
             'phone' => 'required',
        ]);
        $dataval = new Stockiest();
        $dataval->user_id = $request->user_id;
        $dataval->stock_name = $request->stock_name;
        $dataval->trade_license = $request->trade_license;
        $dataval->phone = $request->phone;
        $dataval->address = $request->address;
        $data = $dataval->save();
        if ($data) {
            \DB::table('users')->where('id',$request->user_id)->update([
                'is_stockiest'=> 1,
            ]);
             return redirect('admin/stockiest/index')->with('success', 'Stock has been added');
        } else {
            return redirect()->back()->with('danger', 'Something went wrong');
        }
    }


    public function stockiestOrderSummary()
    {

        // dd('dfff');
        $id = \Auth::user()->id;
        $stockiest_id = Stockiest::where('user_id', $id)->select('id')->first();
        $utype=Auth::user()->type ;
        if($utype==1){
        //   dd('kkkkkkk');
            $orders = Order::get();
        }else{

            // $orders = Stockiest::where('user_id',$id)->with('order')->first();
            $orders = Order::where('stockiest_id',$stockiest_id->id)->get();
        }
        // dd($orders);
        // dd($id);
        $data['status'] = null;
        $data['status_name'] = '';

        $data['totalOrder'] = $orders->groupBy('order_number')->count();
        $data['totalPlacedOrder'] = $orders->where('status',1)->count();
        $data['totalConfirmOrder'] = $orders->where('status',2)->count();
        // $data['totalShippedOrder'] = $orders->where('status',3)->groupBy('order_number')->count();
        $data['totalShippedOrder'] = $orders->where('status',3)->count();
        $data['totalDeleveredOrder'] = $orders->where('status',4)->count();
        $data['totalCancelByVendorOrder'] = $orders->where('status',5)->count();
        $data['totalCancelByUserOrder'] = $orders->where('status',6)->count();
        $data['totalReturnOrder'] = $orders->where('status',8)->count();
        $data['totalAssignRiderOrder'] = $orders->where('status',11)->count();

        $data['totalAmount'] = $totalAmount = 0;

        $data['totalPlaceAmount'] = $totalPlaceAmount = 0;
        $data['totalConfirmAmount'] = $totalConfirmAmount = 0;
        $data['totalShippedAmount'] =$totalShippedAmount = 0;
        $data['totalDeleveredAmount'] =$totalDeleveredAmount = 0;
        $data['totalCancelByVendorAmount'] = $totalCancelByVendorAmount = 0;
        $data['totalCancelByUserAmount'] =$totalCancelByUserAmount = 0;
        $data['totalShippedAmount'] = $totalShippedAmount = 0;
        $data['totalReturnAmount'] = $totalReturnAmount = 0;
        $data['totalAssignRiderAmount'] = $totalAssignRiderAmount = 0;
        $data['totalProduct'] = count($orders);

        foreach($orders as $item){

            $data['totalAmount'] = $totalAmount = $totalAmount + ($item->qty *$item->price );

            if($item->status == 1){

             $data['totalPlaceAmount'] = $totalPlaceAmount = $totalPlaceAmount +($item->qty *$item->price );

            }

            if($item->status == 2){

                $data['totalConfirmAmount'] =$totalConfirmAmount = $totalConfirmAmount +($item->qty *$item->price );

               }

            if($item->status ==3 ){

             $data['totalShippedAmount'] =$totalShippedAmount = $totalShippedAmount +($item->qty *$item->price );

            }

            if($item->status == 4){

                $data['totalDeleveredAmount'] =$totalDeleveredAmount =$totalDeleveredAmount + ($item->qty *$item->price );
            }

            if($item->status == 5){

                $data['totalCancelByVendorAmount'] =$totalCancelByVendorAmount = $totalCancelByVendorAmount + ($item->qty *$item->price );
            }

             if($item->status == 6){

                $data['totalCancelByUserAmount'] =$totalCancelByUserAmount =$totalCancelByUserAmount + ($item->qty *$item->price );

            }

              if($item->status == 8){

                $data['totalReturnAmount'] = $totalReturnAmount = $totalReturnAmount + ($item->qty *$item->price );

            }

            if($item->status == 11){

                $data['totalAssignRiderAmount'] = $totalAssignRiderAmount= $totalAssignRiderAmount + ($item->qty *$item->price );

            }





















        // $data['totalOrder'] = $orders->order->groupBy('order_number')->count();
        // $data['totalPlacedOrder'] = $orders->order->where('status',1)->groupBy('order_number')->count();
        // $data['totalConfirmOrder'] = $orders->order->where('status',2)->groupBy('order_number')->count();
        // $data['totalShippedOrder'] = $orders->order->where('status',3)->groupBy('order_number')->count();
        // $data['totalDeleveredOrder'] = $orders->order->where('status',4)->groupBy('order_number')->count();
        // $data['totalCancelByVendorOrder'] = $orders->order->where('status',5)->groupBy('order_number')->count();
        // $data['totalCancelByUserOrder'] = $orders->order->where('status',6)->groupBy('order_number')->count();
        // $data['totalReturnOrder'] = $orders->order->where('status',8)->groupBy('order_number')->count();
        // $data['totalAssignRiderOrder'] = $orders->order->where('status',11)->groupBy('order_number')->count();

        // $data['totalAmount'] = $totalAmount = 0;

        // $data['totalPlaceAmount'] = $totalPlaceAmount = 0;
        // $data['totalConfirmAmount'] = $totalConfirmAmount = 0;
        // $data['totalShippedAmount'] =$totalShippedAmount = 0;
        // $data['totalDeleveredAmount'] =$totalDeleveredAmount = 0;
        // $data['totalCancelByVendorAmount'] = $totalCancelByVendorAmount = 0;
        // $data['totalCancelByUserAmount'] =$totalCancelByUserAmount = 0;
        // $data['totalShippedAmount'] = $totalShippedAmount = 0;
        // $data['totalReturnAmount'] = $totalReturnAmount = 0;
        // $data['totalAssignRiderAmount'] = $totalAssignRiderAmount = 0;
        // $data['totalProduct'] = count($orders->order);

        // foreach($orders->order as $item){

        //     $data['totalAmount'] = $totalAmount = $totalAmount + ($item->qty *$item->price );

        //     if($item->status == 1){

        //      $data['totalPlaceAmount'] = $totalPlaceAmount = $totalPlaceAmount +($item->qty *$item->price );

        //     }

        //     if($item->status == 2){

        //         $data['totalConfirmAmount'] =$totalConfirmAmount = $totalConfirmAmount +($item->qty *$item->price );

        //        }

        //     if($item->status ==3 ){

        //      $data['totalShippedAmount'] =$totalShippedAmount = $totalShippedAmount +($item->qty *$item->price );

        //     }

        //     if($item->status == 4){

        //         $data['totalDeleveredAmount'] =$totalDeleveredAmount =$totalDeleveredAmount + ($item->qty *$item->price );
        //     }

        //     if($item->status == 5){

        //         $data['totalCancelByVendorAmount'] =$totalCancelByVendorAmount = $totalCancelByVendorAmount + ($item->qty *$item->price );
        //     }

        //      if($item->status == 6){

        //         $data['totalCancelByUserAmount'] =$totalCancelByUserAmount =$totalCancelByUserAmount + ($item->qty *$item->price );

        //     }

        //       if($item->status == 8){

        //         $data['totalReturnAmount'] = $totalReturnAmount = $totalReturnAmount + ($item->qty *$item->price );

        //     }

        //     if($item->status == 11){

        //         $data['totalAssignRiderAmount'] = $totalAssignRiderAmount= $totalAssignRiderAmount + ($item->qty *$item->price );

        //     }


        }


         return view('Admin.stockiest.order_summary',$data);


    }

    public function StockiestStatusActive ($id)
    {
        // dd($id);
        $data = User::find($id);
        $data->update([
            'stockiest_status'=> 1,
        ]);
        return redirect()->back()->with('success', 'Change Status Successfully');
        // dd($id);
    }
    public function StockiestStatusDeactive($id)
    {
        // dd($id);
        $data = User::find($id);
        $data->update([
            'stockiest_status'=> 0,
        ]);
        return redirect()->back()->with('success', 'Change Status Successfully');
    }

    public function searchOrderSummary(Request $request)
    {
        // dd($request->all());
        $from = $request->from_date;
        $to = $request->to_date;
        $data['status_name'] = $status_name = $request->status?? '';
        $data['status'] = 'search';

        // dd($status_name);

        if(!$from && !$to &&  ($status_name =='total'  || $status_name == null)){

            return $this->stockiestOrderSummary();
        }

    $id = \Auth::user()->id;
    $stockiest_id = Stockiest::where('user_id', $id)->select('id')->first();

    $utype=Auth::user()->type ;
    if($utype==1){

      if($from && $to && $status_name){

            $orders = Order::where('status',$status_name)->WhereBetween('created_at', [$request->from_date." 00:00:00", $request->to_date." 23:59:59"])->get();

        }else if(!$from && !$to && $status_name){

            $orders = Order::where('status',$status_name)->get();
        }else{
            $orders = Order::get();
        }


    }else{

        if($from && $to && $status_name){

            $orders = Order::where('stockiest_id',$stockiest_id->id)->where('status',$status_name)->WhereBetween('created_at', [$request->from_date." 00:00:00", $request->to_date." 23:59:59"])->get();

        }else if(!$from && !$to && $status_name){

            $orders = Order::where('stockiest_id',$stockiest_id->id)->where('status',$status_name)->get();
        }else{

            $orders = Order::where('stockiest_id',$stockiest_id->id)->get();
        }
 
    }


    $data['totalOrder'] = $orders->groupBy('order_number')->count();
    $data['totalPlacedOrder'] = $orders->where('status',1)->count();
    $data['totalConfirmOrder'] = $orders->where('status',2)->count();
    $data['totalShippedOrder'] = $orders->where('status',3)->count();
    $data['totalDeleveredOrder'] = $orders->where('status',4)->count();
    $data['totalCancelByVendorOrder'] = $orders->where('status',5)->count();
    $data['totalCancelByUserOrder'] = $orders->where('status',6)->count();
    $data['totalReturnOrder'] = $orders->where('status',8)->count();
    $data['totalAssignRiderOrder'] = $orders->where('status',11)->count();
    //  dd($data);
    $data['totalAmount'] = $totalAmount = 0;

    $data['totalPlaceAmount'] = $totalPlaceAmount = 0;
    $data['totalConfirmAmount'] = $totalConfirmAmount = 0;
    $data['totalShippedAmount'] =$totalShippedAmount = 0;
    $data['totalDeleveredAmount'] =$totalDeleveredAmount = 0;
    $data['totalCancelByVendorAmount'] = $totalCancelByVendorAmount = 0;
    $data['totalCancelByUserAmount'] =$totalCancelByUserAmount = 0;
    $data['totalShippedAmount'] = $totalShippedAmount = 0;
    $data['totalReturnAmount'] = $totalReturnAmount = 0;
    $data['totalAssignRiderAmount'] = $totalAssignRiderAmount = 0;
    $data['totalProduct'] = count($orders);

    foreach($orders as $item){

        $data['totalAmount'] = $totalAmount = $totalAmount + ($item->qty *$item->price );

        if($item->status == 1){

         $data['totalPlaceAmount'] = $totalPlaceAmount = $totalPlaceAmount +($item->qty *$item->price );

        }

        if($item->status == 2){

            $data['totalConfirmAmount'] =$totalConfirmAmount = $totalConfirmAmount +($item->qty *$item->price );

           }

        if($item->status ==3 ){

         $data['totalShippedAmount'] =$totalShippedAmount = $totalShippedAmount +($item->qty *$item->price );

        }

        if($item->status == 4){

            $data['totalDeleveredAmount'] =$totalDeleveredAmount =$totalDeleveredAmount + ($item->qty *$item->price );
        }

        if($item->status == 5){

            $data['totalCancelByVendorAmount'] =$totalCancelByVendorAmount = $totalCancelByVendorAmount + ($item->qty *$item->price );
        }

         if($item->status == 6){

            $data['totalCancelByUserAmount'] =$totalCancelByUserAmount =$totalCancelByUserAmount + ($item->qty *$item->price );

        }

          if($item->status == 8){

            $data['totalReturnAmount'] = $totalReturnAmount = $totalReturnAmount + ($item->qty *$item->price );

        }

        if($item->status == 11){

            $data['totalAssignRiderAmount'] = $totalAssignRiderAmount= $totalAssignRiderAmount + ($item->qty *$item->price );

        }


    }

    return view('Admin.stockiest.order_summary',$data);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $user = User::where('type',2)->get();
       $stock = Stockiest::find($id);
       return view('Admin.stockiest.update',compact('user','stock'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'user_id' => 'required',
            'stock_name' => 'required',
            'address' => 'required',
        ]);
        $dataval = Stockiest::find($id);
        $dataval->user_id = $request->user_id;
        $dataval->stock_name = $request->stock_name;
        $dataval->address = $request->address;
        $data = $dataval->save();
        if ($data) {
             return redirect('admin/stockiest/index')->with('success', 'Stock has been updated');
        } else {
            return redirect()->back()->with('danger', 'Something went wrong');
        }
    }



    public function search(Request $request)
    {
        $data=Stockiest::where('stock_name', 'LIKE', '%' . $request->search . '%')->orWhere('address', 'LIKE', '%' . $request->search . '%')->orderBy('id', 'DESC')->paginate(10);
        return view('Admin.stockiest.index',compact('data'));

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $dataval = Stockiest::find($id);
        $data = $dataval->delete();
        if ($data) {
            return 1000;
            //  return redirect('admin/stockiest/index')->with('success', 'Stock has been deleted');
        } else {
            return redirect()->back()->with('danger', 'Something went wrong');
        }
    }
}