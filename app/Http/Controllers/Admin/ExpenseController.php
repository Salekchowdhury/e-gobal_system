<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Expense;
use App\Models\Acc_head;
use App\Models\ProductWiseIncome;
use App\Models\DistributeFundAmount;
use Auth;
use DB;
class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $data['acc_head'] = Acc_head::OrderBy('id','DESC')->get();
       $data['datas'] = Expense::OrderBy('id','DESC')->get();
       return view('Admin.expense.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request){
        $id = Auth::user()->id;
        $total_income = ProductWiseIncome::select(DB::raw("SUM(admin_profit) as adminIncome"))->first();
        $expense = Expense::where('acc_head','Product Sales')->select(DB::raw("SUM(amount) as totalAmount"))->first();
        // $expense = Expense::where('user_id',$id)->select(DB::raw("SUM(amount) as totalAmount"))->first();
        $prodcut_wise_income = $total_income->adminIncome - $expense->totalAmount;

          if($request->acc_head == 'Poor Fund'){
            $input_title = 'Poor';
          }else{
            $input_title = $request->acc_head;
          }
        $ttlIncentiveAmount = DistributeFundAmount::where('fund_title',$input_title)->select(DB::raw("SUM(amount) as incentive_amount"))->first();
        $ttlexpensAmount= Expense::where('acc_head',$request->acc_head)->select(DB::raw("SUM(amount) as expAmount"))->first();
        $left_amount_is =$ttlIncentiveAmount->incentive_amount-$ttlexpensAmount->expAmount;

        // $ttlIncentiveAmount = DistributeFundAmount::where('fund_title','Incentive')->select(DB::raw("SUM(amount) as incentive_amount"))->first();
        // $ttlexpensAmount= Expense::where('acc_head','Incentive')->select(DB::raw("SUM(amount) as expAmount"))->first();
        // $left_incentive=$ttlIncentiveAmount->incentive_amount-$ttlexpensAmount->expAmount;


        // dd($expens_amount);

        $date = date("Y/m/d");
        $inputs = $request->all();
        $inputs['date'] = $date;
        $inputs['user_id'] = $id;

    if($request->acc_head == 'Product Sales'){
        if($prodcut_wise_income > $request->amount){
            $user = User::find($id);
            // dd( $user,$id);
            $update_price = $user->wallet-$request->amount;
            $user->update([
              'wallet'=>$update_price,
            ]);

            Expense::create($inputs);
            return response()->json([
                'status'=>200,
                'message'=>'Added Expense Successfully',
             ]);
        }else{
         return response()->json([
            'status'=>400,
            'amount'=>$prodcut_wise_income,
            'message'=>'You Can not expense more than',
         ]);
        }
    }else{
        if($left_amount_is > $request->amount){
            $user = User::find($id);
            // dd( $user,$id);
            $update_price = $user->wallet-$request->amount;
            $user->update([
              'wallet'=>$update_price,
            ]);
                    Expense::create($inputs);
                    return response()->json([
                        'status'=>200,
                        'message'=>'Added Expense Successfully',
                     ]);
                }else{
                 return response()->json([
                    'status'=>400,
                    'amount'=>$left_amount_is,
                    'message'=>'You Can not expense more than',
                 ]);
                }
    }
    // if($request->acc_head == 'Incentive'){
    //     if($left_incentive > $request->amount){

    //         Expense::create($inputs);
    //         return response()->json([
    //             'status'=>200,
    //             'message'=>'Added Expense Successfully',
    //          ]);
    //     }else{
    //      return response()->json([
    //         'status'=>400,
    //         'amount'=>$left_incentive,
    //         'message'=>'You Can not expense more than',
    //      ]);
    //     }
    // }


    // if($request->acc_head == 'Incentive'){
    //     if($left_incentive > $request->amount){
    //         Expense::create($inputs);
    //         return response()->json([
    //             'status'=>200,
    //             'message'=>'Added Expense Successfully',
    //          ]);
    //     }else{
    //      return response()->json([
    //         'status'=>400,
    //         'amount'=>$left_incentive,
    //         'message'=>'You Can not expense more than',
    //      ]);
    //     }
    // }

    // if($request->acc_head == '1st Star'){
    //     if($left_first_star > $request->amount){

    //         Expense::create($inputs);
    //         return response()->json([
    //             'status'=>200,
    //             'message'=>'Added Expense Successfully',
    //          ]);
    //     }else{
    //      return response()->json([
    //         'status'=>400,
    //         'amount'=>$left_first_star,
    //         'message'=>'You Can not expense more than',
    //      ]);
    //     }
    // }

    // if($request->acc_head == '2nd Star'){
    //     if($left_second_star > $request->amount){

    //         Expense::create($inputs);
    //         return response()->json([
    //             'status'=>200,
    //             'message'=>'Added Expense Successfully',
    //          ]);
    //     }else{
    //      return response()->json([
    //         'status'=>400,
    //         'amount'=>$left_second_star,
    //         'message'=>'You Can not expense more than',
    //      ]);
    //     }
    // }

    // if($request->acc_head == '2nd Star'){
    //     if($left_second_star > $request->amount){

    //         Expense::create($inputs);
    //         return response()->json([
    //             'status'=>200,
    //             'message'=>'Added Expense Successfully',
    //          ]);
    //     }else{
    //      return response()->json([
    //         'status'=>400,
    //         'amount'=>$left_second_star,
    //         'message'=>'You Can not expense more than',
    //      ]);
    //     }
    // }


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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}