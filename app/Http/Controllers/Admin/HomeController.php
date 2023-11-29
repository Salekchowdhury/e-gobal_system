<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use App\Models\Order;
use App\Models\Payout;
use App\Models\Settings;
use App\Models\Products;
use App\Models\DistributeFundAmount;
use App\Models\FundDistribution;
use App\Models\Bank;
use App\Models\ProductCommissionDistribution;
use App\Models\SalesCommission;
use App\Models\ProductWiseIncome;
use App\Models\Stockiest;
use App\Models\Withdraw;
use App\Models\Expense;
use App\Models\TransactionHistory;
use App\Models\RetuenProductWiseIncome;

use Hash;
use Auth;
use DB;
use Carbon\Carbon;
use Helper;

class HomeController extends Controller
{
    public function index(Request $request)
    {
    //    dd(Auth::user()->type);
        if(Auth::user()->type == 1) {

            $order_summary = $this->searchOrderSummary();
            // dd($checkS);
            // $data['order_summary'] = $order_summary;

            $ttlIncentiveAmount = DistributeFundAmount::where('fund_title','Incentive')->select(DB::raw("SUM(amount) as incentive_amount"))->first();
            $ttlexpensAmount= Expense::where('acc_head','Incentive')->select(DB::raw("SUM(amount) as expAmount"))->first();
            $data['ttlexpens_amount'] = $ttlIncentiveAmount->incentive_amount - $ttlexpensAmount->expAmount;

            $ttlPoorAmount = DistributeFundAmount::where('fund_title','Poor')->select(DB::raw("SUM(amount) as total_amount"))->first();
            $ttlPoorexpensAmount= Expense::where('acc_head','Poor Fund')->select(DB::raw("SUM(amount) as expAmount"))->first();
            $data['ttlPoorexpens_Amount'] = $ttlPoorAmount->total_amount - $ttlPoorexpensAmount->expAmount;


            $ttlPensionAmount = DistributeFundAmount::where('fund_title','Pension Fund')->select(DB::raw("SUM(amount) as total_amount"))->first();
            $ttlPensionexpensAmount= Expense::where('acc_head','Pension Fund')->select(DB::raw("SUM(amount) as expAmount"))->first();
            $data['ttlPensionexpens_Amount'] = $ttlPensionAmount->total_amount - $ttlPensionexpensAmount->expAmount;

            $ttlReligionAmount = DistributeFundAmount::where('fund_title','Religion Fund')->select(DB::raw("SUM(amount) as total_amount"))->first();
            $ttlReligionExpensAmount= Expense::where('acc_head','Religion Fund')->select(DB::raw("SUM(amount) as expAmount"))->first();
            $data['ttlReligionexpens_Amount'] = $ttlReligionAmount->total_amount - $ttlReligionExpensAmount->expAmount;

            $ttlHealthAmount = DistributeFundAmount::where('fund_title','Health Fund')->select(DB::raw("SUM(amount) as total_amount"))->first();
            $ttlHealthExpensAmount= Expense::where('acc_head','Health Fund')->select(DB::raw("SUM(amount) as expAmount"))->first();
            $data['ttlHealthexpens_Amount'] = $ttlHealthAmount->total_amount - $ttlHealthExpensAmount->expAmount;

             $ttl_1stStarAmount = DistributeFundAmount::where('fund_title','1st Star')->select(DB::raw("SUM(amount) as total_amount"))->first();
            $ttl1stStarExpensAmount= Expense::where('acc_head','1st Star')->select(DB::raw("SUM(amount) as expAmount"))->first();
            $data['fstar_Amount']=$ttl_1stStarAmount->total_amount;
            $data['ttl1stStarexpens_Amount'] = $ttl_1stStarAmount->total_amount - $ttl1stStarExpensAmount->expAmount;

             $ttl_2ndStarAmount = DistributeFundAmount::where('fund_title','2nd Star')->select(DB::raw("SUM(amount) as total_amount"))->first();
            $ttl2ndStarExpensAmount= Expense::where('acc_head','2nd Star')->select(DB::raw("SUM(amount) as expAmount"))->first();
            $data['ttl2ndStarexpens_Amount'] = $ttl_2ndStarAmount->total_amount - $ttl2ndStarExpensAmount->expAmount;

             $ttl_3rdStarAmount = DistributeFundAmount::where('fund_title','3rd Star')->select(DB::raw("SUM(amount) as total_amount"))->first();
            $ttl3rdStarExpensAmount= Expense::where('acc_head','3rd Star')->select(DB::raw("SUM(amount) as expAmount"))->first();
            $data['ttl3rdStarexpens_Amount'] = $ttl_3rdStarAmount->total_amount - $ttl3rdStarExpensAmount->expAmount;




            $data["ttlboostingCharge"] = Withdraw::select(DB::raw("SUM(extra_charge) as boostChargr"))->first();
        	$data["ttlvendors"] = User::where('type','3')->get();
        	$data["ttlusers"] = User::where('type','2')->get();
            $data["ttlpayrequest"] = Payout::where('status','1')->get();
            $data["ttlproducts"] = Products::get();
            $data["ttlorders"] = Order::where('status','!=','8')->get();
            $data["ttlstockiest"] = Stockiest::get();
            $data["ttlreturn"] = Order::where('status','8')->get();
            $data["ttlcancel"] = Order::where('status','5')->orWhere('status','6')->get();
            $data["ttlDelivered"] = Order::where('status','4')->groupBy('order_number')->get();
            $data["ttlvalueofsales"] = Order::where('status','4')->sum('order_total');
            $data["total_commission"] = ProductCommissionDistribution::select(DB::raw("SUM(amount) as commission"))->first();
            $data["total_stockiest_amount"] = SalesCommission::select(DB::raw("SUM(amount) as stockiest"))->first();
            $product_wise_income = ProductWiseIncome::select(DB::raw("SUM(admin_profit) as adminIncome"))->first();
            // dd($product_wise_income->adminIncome);
            // $data["total_expense"] = $expense = Expense::where('user_id',Auth::user()->id)->select(DB::raw("SUM(amount) as totalAmount"))->first();
            $data["total_expense"] = $expense = Expense::select(DB::raw("SUM(amount) as totalAmount"))->first();

            $data["total_income"] = ($product_wise_income->adminIncome) - ($expense->totalAmount);

            $data["total_delivery_charge"] = ProductWiseIncome::select(DB::raw("SUM(delivery_charge) as deliveryCharge"))->first();
            $data["total_return_delivery_charge"] = RetuenProductWiseIncome::select(DB::raw("SUM(delivery_charge) as deliveryCharge"))->first();

            // $walletbalance=User::select('wallet')
            // ->where('id', $user_id)
            // ->where('type', 1)
            // ->first();
        //    dd($data["total_return_delivery_charge"]);

            $data["orders"] = Order::select(
                        DB::raw("MONTHNAME(created_at) as month_name"),
                        DB::raw("SUM(order_total) as amount"))
                    ->orderBy('created_at')
                    ->groupBy(DB::raw("MONTHNAME(created_at)"))
                    ->where("created_at",">", Carbon::now()->subDays(2))
                    ->get();

            $data["linereport"] = Order::select(
                        DB::raw("MONTHNAME(created_at) as month_name"),
                        DB::raw("count(id) as orders"))
                    ->orderBy('created_at')
                    ->groupBy(DB::raw("MONTHNAME(created_at)"))
                    ->where("created_at",">", Carbon::now()->subMonths(6))
                    ->get();

            $data["users"] = User::select(
                        DB::raw("MONTHNAME(created_at) as month_name"),
                        DB::raw("count(id) as total"))
                    ->orderBy('created_at')
                    ->groupBy(DB::raw("MONTHNAME(created_at)"))
                    ->where("type", '2')
                    ->where("created_at",">", Carbon::now()->subMonths(6))
                    ->get();

            $data["data"]=Order::with(['vendors'])->select('order_number','vendor_id','order_notes','full_name','email','mobile','landmark','street_address','pincode','status',\DB::raw('SUM(order_total) AS grand_total'),\DB::raw('DATE_FORMAT(created_at, "%d %M %Y") as date'),\DB::raw('count(order_number) AS no_products'))
            ->groupBy('order_number')
            ->orderBy('id', 'DESC')
            ->paginate(6);

            $data['datas']= $data['datas'] =  Order::with(['vendors', 'stockiest'])
            ->select('id', 'order_number', 'vendor_id', 'order_notes', 'full_name', 'email', 'mobile', 'landmark', 'stockiest_id', 'stock_name', 'admin_status', 'street_address', 'pincode', 'status', \DB::raw('SUM(order_total) AS grand_total'), \DB::raw('DATE_FORMAT(created_at, "%d %M %Y") as date'), \DB::raw('count(order_number) AS no_products'))
            ->groupBy('order_number')
            ->orderBy('id', 'DESC')
            ->get();
        }

        if(Auth::user()->type == 3) {
            $order_summary = [];
            $id =Auth::user()->id;
            $is_stockiest = Stockiest::where('user_id',$id)->first();
            $data["ttlstockiestAmount"] = 0;

            if(!empty($is_stockiest)){
                $data["ttlstockiestAmount"] = SalesCommission::where('user_id',$id)->sum('amount');
            }
            // dd($data["ttlstockiestAmount"]);
            $refer_code = Auth::user()->referral_code;
            $refer_ids = User::where('refferal_vendor',$refer_code)->pluck('id');
            // dd($refer_ids);
            // $checkStockiest  = Stockiest::find($id);
            // $data["total_commission"] = '';
            // $data["total_stockiest"] = '';
            $data["ttlvendors"] = array();
            $data["ttlusers"] = array();
            $data["ttlstockiest"] = Stockiest::get();
            $data["ttlpayrequest"] = Payout::where('vendor_id',Auth::user()->id)->where('status','1')->get();
            $data["ttlproducts"] = Products::where('vendor_id',Auth::user()->id)->get();
            $data["ttlorders"] = Order::where('vendor_id',Auth::user()->id)->where('status','!=','8')->get();
            $data["ttlreturn"] = Order::where('vendor_id',Auth::user()->id)->where('status','8')->get();
            $data["ttlDelivered"] = Order::where('status','4')->where('vendor_id',Auth::user()->id)->groupBy('order_number')->get();
            $data["ttlcancel"] = Order::where('vendor_id',Auth::user()->id)->where('status','5')->orWhere('status','6')->get();
            $data["ttlvalueofsales"] = Order::whereIn('vendor_id',$refer_ids)->where('status','4')->sum('order_total');
            $data["total_income"] = ProductWiseIncome::where('vendor_id',Auth::user()->id)->select(DB::raw("SUM(vendor_profit) as profit"))->first();
            $data["total_delivery_charge"] = ProductWiseIncome::where('vendor_id',Auth::user()->id)->select(DB::raw("SUM(delivery_charge) as deliveryCharge"))->first();
            $data["total_return_delivery_charge"] = RetuenProductWiseIncome::where('vendor_id',Auth::user()->id)->select(DB::raw("SUM(delivery_charge) as deliveryCharge"))->first();

            $data["orders"] = Order::select(
                        DB::raw("MONTHNAME(created_at) as month_name"),
                        DB::raw("SUM(order_total) as amount"))
                    ->where('vendor_id',Auth::user()->id)
                    ->orderBy('created_at')
                    ->groupBy(DB::raw("MONTHNAME(created_at)"))
                    ->where("created_at",">", Carbon::now()->subDays(3))
                    ->get();

            $data["linereport"] = Order::select(
                        DB::raw("MONTHNAME(created_at) as month_name"),
                        DB::raw("count(id) as orders"))
                    ->where('vendor_id',Auth::user()->id)
                    ->orderBy('created_at')
                    ->groupBy(DB::raw("MONTHNAME(created_at)"))
                    ->where("created_at",">", Carbon::now()->subMonths(6))
                    ->get();

            $data["users"] = array();

            $data["data"]=Order::with(['vendors'])->select('order_number','vendor_id','order_notes','full_name','email','mobile','landmark','street_address','pincode','status',\DB::raw('SUM(order_total) AS grand_total'),\DB::raw('DATE_FORMAT(created_at, "%d %M %Y") as date'),\DB::raw('count(order_number) AS no_products'))
            ->where('vendor_id',Auth::user()->id)
            ->orderBy('id', 'DESC')
            ->groupBy('order_number');

            $data['datas'] =  Order::with(['vendors', 'stockiest'])
            ->select('id', 'order_number', 'vendor_id', 'order_notes', 'full_name', 'email', 'mobile', 'landmark', 'stockiest_id', 'stock_name', 'admin_status', 'street_address', 'pincode', 'status', \DB::raw('SUM(order_total) AS grand_total'), \DB::raw('DATE_FORMAT(created_at, "%d %M %Y") as date'), \DB::raw('count(order_number) AS no_products'))
            ->where('vendor_id', Auth::user()->id)
            ->groupBy('order_number')
            ->orderBy('id', 'DESC')
            ->get();
            // dd($data);
        }

        //   $distributeFund =DistributeFundAmount::groupBy('fund_title')->orderBy('fund_title','ASC')
        //   ->selectRaw('fund_title, sum(amount) as tamount')
        //   ->get();

           $fund_titles = FundDistribution::get()->pluck('title','title_key');
           foreach($fund_titles as $key=>$title){
            //  dd($key,$title);
             $data['total_'.$key] = DistributeFundAmount::where('fund_title',$title)
             ->selectRaw('sum(amount) as tamount')
             ->first();
            }
            $data['fund_titles_length'] = count($fund_titles);


        // return view('Admin.home',compact('ttlvendors','ttlusers','ttlpayrequest','ttlproducts','ttlorders','ttlreturn','ttlcancel','ttlvalueofsales','orders','linereport','users','data','total_stockiest','total_commission','distributeFund','total_income','total_delivery_charge','ttlstockiest','ttlDelivered'));
// dd($data);
        return view('Admin.home',$data, $order_summary);
    }

    public function transactionHisoryt(Request $request){
    //   dd('dddddd');
    //  $data['all_transaction_history'] =$history= DB::table('transaction_history')->get();
      $history= TransactionHistory::with('user')->get();
     if(Auth::user()->type == 1){
         $data['single_history_data'] =$history;

     }else{
         $data['single_history_data'] =TransactionHistory::with('user')->where('uid',Auth::user()->id)->get();

     }
    //  dd($data);
     return view('Admin.transaction_history.index',$data);
    }

    public function changepassword(Request $request)
    {
        $this->validate($request,[
            'oldpassword'=>'required|min:6',
            'newpassword'=>'required|min:6',
            'confirmpassword'=>'required_with:newpassword|same:newpassword|min:6',
        ]);

        if(\Hash::check($request->oldpassword,Auth::user()->password)){
            $data=array('password'=>Hash::make($request->newpassword));
            $changepass=User::find(Auth::user()->id)->update($data);
        }else{
            return 3;
        }

        if ($changepass) {
            return 1;
        } else {
            return 2;
        }
    }

    public function withdrawal(Request $request)
    {
        $this->validate($request,[
            'balance'=>'required',
        ]);

        $bankdetails=Bank::where('vendor_id', Auth::user()->id)->first();
        if (empty($bankdetails)) {
            return redirect()->back()->with('danger', "Please provide Bank information before making withdrawal request.");
        } else {
            $request_id = substr(str_shuffle(str_repeat("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ", 10)), 0, 10);

            $checkbalance=Settings::select('min_balance','admin_commission')->first();

            if ($request->balance >= $checkbalance->min_balance) {

                $commission = ($request->balance*$checkbalance->admin_commission)/100;

                $paid_amount = $request->balance-$commission;

                $dataval=array('request_id'=>$request_id,'vendor_id'=>Auth::user()->id,'amount'=>$request->balance,'commission_pr'=>$checkbalance->admin_commission,'commission'=>$commission,'paid_amount'=>$paid_amount,'status'=>'1');
                $data=Payout::create($dataval);
                return redirect()->back()->with('success', "Withdrawal request has been sent");
            } else {
                return redirect()->back()->with('danger', "Insufficient balance at least ".Helper::CurrencyFormatter($checkbalance->min_balance)." required");
            }
        }
    }

    public function searchOrderSummary()
    {
        // dd($request->all());


    $id = \Auth::user()->id;

    $orders = Stockiest::with('order')->first();

    $data['totalOrder'] = $orders->order->groupBy('order_number')->count();
    $data['totalPlacedOrder'] = $orders->order->where('status',1)->groupBy('order_number')->count();
    $data['totalConfirmOrder'] = $orders->order->where('status',2)->groupBy('order_number')->count();
    $data['totalShippedOrder'] = $orders->order->where('status',3)->groupBy('order_number')->count();
    $data['totalDeleveredOrder'] = $orders->order->where('status',4)->groupBy('order_number')->count();
    $data['totalCancelByVendorOrder'] = $orders->order->where('status',5)->groupBy('order_number')->count();
    $data['totalCancelByUserOrder'] = $orders->order->where('status',6)->groupBy('order_number')->count();
    $data['totalReturnOrder'] = $orders->order->where('status',8)->groupBy('order_number')->count();
    $data['totalAssignRiderOrder'] = $orders->order->where('status',11)->groupBy('order_number')->count();
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
    $data['totalProduct'] = count($orders->order);

    foreach($orders->order as $item){

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
 return $data;
}

}
