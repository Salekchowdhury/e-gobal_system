<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductWiseIncome;
use App\Models\Expense;
use App\Models\User;
use Auth;
use DB;
class ProductWiseIncomeController extends Controller
{
    public function index(){
        if (Auth::user()->type == 1) {
            $datas = ProductWiseIncome::with(['vendor', 'product'])->orderBy('generated_date','desc')->get();
        }
        if (Auth::user()->type == 3) {
            $datas = ProductWiseIncome::with(['vendor', 'product'])->where('vendor_id', Auth::user()->id)->orderBy('generated_date','desc')->get();

        }
        // dd($datas);
        return view('Admin.product_wise_income.index', compact('datas'));
    }

  

}