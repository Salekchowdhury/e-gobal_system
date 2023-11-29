<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SalesCommission;
// use App\Models\SalesCommission;
use Auth;
use DB;
class SalesCommissionController extends Controller
{
    public function index()
    {
        // dd(Auth::user()->id);
        if(Auth::user()->type == 1){
            $salesCommissions =SalesCommission::with(['stockiest','product'])->orderBy('id','DESC')->get();


            // dd($stockiest_amount->total_stockiest);
            return view('Admin.salesCommission.index', compact('salesCommissions'));
            // dd($http_response_header);

        }

        if(Auth::user()->type == 3){
            $id = Auth::user()->id;
            $salesCommissions =SalesCommission::where('user_id',$id)->whereHas('stockiest',function($query){
                $query->where('user_id',\Auth::user()->id);
            })->with(['stockiest','product'])->orderBy('id','DESC')->get();
            // dd($http_response_header);
            return view('Admin.salesCommission.index', compact('salesCommissions'));
        }


        //  dd($salesCommissions);
    }

    public function searchUserCommission(Request $request)
    {
        $id =\Auth::user()->id;

        $from = $request->from_date;
        $to = $request->to_date;

        if(!$from){
            return $this->index();
        }

        if(Auth::user()->type == 1){
            $salesCommissions =SalesCommission::with(['stockiest','product'])->orderBy('id','DESC')
            ->whereBetween('created_at', [$request->from_date." 00:00:00", $request->to_date." 23:59:59"])
            ->get();
            return view('Admin.salesCommission.index', compact('salesCommissions'));

        }

        if(Auth::user()->type == 3){
        $salesCommissions =SalesCommission::where('user_id',$id)->whereHas('stockiest',function($query){
        $query->where('user_id',\Auth::user()->id);
        })->with(['stockiest','product'])
        ->whereBetween('created_at', [$request->from_date." 00:00:00", $request->to_date." 23:59:59"])
        ->orderBy('id','DESC')->get();
        return view('Admin.salesCommission.index', compact('salesCommissions'));
        }




    }




}