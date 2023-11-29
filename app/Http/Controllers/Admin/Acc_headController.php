<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Expense;
use App\Models\Acc_head;
use App\Models\ProductWiseIncome;
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
        $expense = Expense::where('user_id',$id)->select(DB::raw("SUM(amount) as totalAmount"))->first();
        $prodcut_wise_income = $total_income->adminIncome - $expense->totalAmount;

        if($prodcut_wise_income > $request->amount){
            $user = User::find($id);
            // dd( $user,$id);
            $update_price = $user->wallet-$request->amount;
            $user->update([
              'wallet'=>$update_price,
            ]);
            // dd('kkk',$total_income->adminIncome);
            $date = date("Y/m/d");
            $inputs = $request->all();
            $inputs['date'] = $date;
            $inputs['user_id'] = $id;

            // dd($inputs);
            Expense::create($inputs);
            return response()->json([
                'status'=>200,
                'message'=>'You Can not expense more than',
             ]);
        }else{
            // dd('ooo',$total_income->adminIncome);
         return response()->json([
            'status'=>400,
            'amount'=>$prodcut_wise_income,
            'message'=>'You Can not expense more than',
         ]);
        }
    //   dd($request->all());
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