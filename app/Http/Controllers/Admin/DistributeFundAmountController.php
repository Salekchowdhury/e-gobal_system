<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FundDistribution;
use App\Models\Settings;
use App\Helpers\Helper;

class DistributeFundAmountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd('dd');
        $data['distribute_amount'] = Settings::select('distribute_amount')->first();
        $data['datas'] = FundDistribution::all();
        // dd($data);
        return view('Admin.fund_distribution.index',$data);
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
    public function store(Request $request)
    {
        // $inputs = $request->except('_token');
        $distributeAmount = Helper::webinfo()->distribute_amount;
        // dd($request->all());
        if($request->total_amount > $distributeAmount){
            return redirect()->back()->with('wrong',' Sorry amount distribution is not currect');
        }else{
            $sum = 0;
            $inputs = $request->all();
            // dd( $inputs);
            $distribute_amount = Settings::select('distribute_amount')->first();

            foreach($inputs as $key => $value)
            {
                $fund_distributions = FundDistribution::where('title_key', $key)->first();

                if($fund_distributions)
                {

                // $fund_distributions->amount = ($value/$distribute_amount->distribute_amount);
                $fund_distributions->amount = (int) $value;
                    $fund_distributions->update();

                }

            }

            return redirect()->back()->with('message','Updated Successfully');
        }

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