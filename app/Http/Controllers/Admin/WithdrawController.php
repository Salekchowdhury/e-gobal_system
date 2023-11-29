<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use  App\Models\{
    Withdraw, User,Settings,BankList
};

class WithdrawController extends Controller
{

    public function index()

    {

        $id = \Auth::user()->id;
        $type = \Auth::user()->type;
        $data['users'] = User::get();
        if($type == 1){
            $data['withdrawDataMobileBank'] = Withdraw::with(['admin','user'])->where('payment_type', '!=', 'Bank')->orderBy('withdraw_date','DESC')->get();
            $data['withdrawDataBank'] = Withdraw::with(['admin','user','bankList'])->where('payment_type', 'Bank')->orderBy('withdraw_date','DESC')->get();
            // dd($withdrawData);
        }else{
            $data['withdrawDataMobileBank'] = Withdraw::where('user_id', $id)->where('payment_type', '!=', 'Bank')->orderBy('withdraw_date','DESC')->get();
            $data['withdrawDataBank'] = Withdraw::with(['admin','user','bankList'])->where('user_id', $id)->where('payment_type', 'Bank')->orderBy('withdraw_date','DESC')->get();
        }
        // dd($data);
        return view('Admin.withdraw.index', $data);
    }


    public function payment(){
        $data['mobileBankPayment'] = Withdraw::with(['admin','user'])->where('status',1)->where('payment_type', '!=', 'Bank')->orderBy('withdraw_date','DESC')->get();
        $data['bankPayment'] = Withdraw::with(['admin','user','bankList'])->where('status',1)->where('payment_type', 'Bank')->orderBy('withdraw_date','DESC')->get();
        $data['total_bank_amount'] = Withdraw::with(['admin','user','bankList'])->where('status',1)->where('payment_type', 'Bank')->select(\DB::raw("SUM(final_amount) as total"))->first();
        $data['total_mobile_bank_amount'] = Withdraw::where('status',1)->where('payment_type','!=', 'Bank')->select(\DB::raw("SUM(final_amount) as total"))->first();
        // dd($data);
        return view('Admin.withdraw.payment', $data);
    }

    public function acceptWithdrawPayment($id){
    //  dd($id);
        $data = Withdraw::findOrFail($id);
        $data->update(['status'=>2]);
        return redirect()->back()->with('message', 'Payment Successful');
    }
    public function withdrawSearch(Request $request)
    {

    $from = $request->from_date;
    $to = $request->to_date;
    $user_id = $request->user_id;

    $id = \Auth::user()->id;
    $type = \Auth::user()->type;
    $users = User::get();

    if(!$from && !$to && !$user_id){

        return $this->index();
    }
    else if($from && $to && $user_id){

        if($type == 1){
            $withdrawData = Withdraw::where('user_id',$user_id)
            ->whereBetween('created_at', [$request->from_date." 00:00:00", $request->to_date." 23:59:59"])
            ->with(['admin','user'])->get();
            // dd($withdrawData);
        }else{
            $withdrawData = Withdraw::where('user_id', $id)
            ->whereBetween('created_at', [$request->from_date." 00:00:00", $request->to_date." 23:59:59"])
            ->get();
        }
    }
    else if($from && $to && !$user_id){
        if($type == 1){
            $withdrawData = Withdraw::whereBetween('created_at', [$request->from_date." 00:00:00", $request->to_date." 23:59:59"])
            ->with(['admin','user'])->get();
            // dd($withdrawData);
        }else{
            $withdrawData = Withdraw::where('user_id', $id)
            ->whereBetween('created_at', [$request->from_date." 00:00:00", $request->to_date." 23:59:59"])
            ->get();
        }
    }

    else if(!$from && !$to && $user_id){
        if($type == 1){
            $withdrawData = Withdraw::where('user_id',$user_id)
            ->with(['admin','user'])->get();
            // dd($withdrawData);
        }else{
            $withdrawData = Withdraw::where('user_id', $id)
            ->whereBetween('created_at', [$request->from_date." 00:00:00", $request->to_date." 23:59:59"])
            ->get();
        }
    }
    return view('Admin.withdraw.index', compact('withdrawData','users'));
    }

    public function create()
    {
        $data['banks'] = BankList::get();
        $data['amount'] = User::where('id',\Auth::user()->id)->select('wallet')->first();
        // dd($data);
        return view('Admin.withdraw.create',$data);
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $settingData = Settings::select('withdraw_charge','min_balance')->first();
        if($settingData->min_balance <= $request->amount){
            $id = \Auth::user()->id;
            $user = User::where('id',$id)->select('wallet','password')->first();
            $currentDate = date('Y-m-d');
            $amount = $request->amount;
            $password = $request->password;
            $commission = ($amount * $settingData->withdraw_charge)/100;
            // dd($commission);
            $final_amount = ($amount - $commission);
            $current_amount_wallet = $user->wallet - $amount;

            if($user){
               if(Hash::check($password, $user->password)){

                if($amount <= $user->wallet){
                 if($request->payment_type =='Bank'){
                    // dd('bank');
                    $withdraw = Withdraw::create([
                        'user_id'=> $id,
                        'amount'=> $amount,
                        'commission'=> $commission,
                        'final_amount'=> $final_amount,
                        'withdraw_date'=> $currentDate,
                        'payment_type'=> $request->payment_type,
                        'city'=> $request->city,
                        'bank_list_id'=> $request->bank_list_id,
                        'account_name'=> $request->account_name,
                        'account_number'=> $request->account_number,
                        'branch_name'=> $request->branch_name,
                        'routin_number'=> $request->routin_number,
                     ]);
                 }else{
                    // dd('mobile');
                    $withdraw = Withdraw::create([
                        'user_id'=> $id,
                        'amount'=> $amount,
                        'commission'=> $commission,
                        'final_amount'=> $final_amount,
                        'withdraw_date'=> $currentDate,
                        'mobile_number'=> $request->mobile_number,
                        'payment_type'=> $request->payment_type,
                     ]);
                 }


                    if($withdraw){
                       $update_wallet = \DB::table('users')
                        ->where('id', $id)
                        ->update(['wallet'=> $current_amount_wallet]);
                    //  $update_wallet =  User::find($id)->update(['wallet'=> $current_amount_wallet]);

                     if($update_wallet){
                        return redirect('admin/withdraw/create')->with('successMessage', 'Withdraw successfully');
                     }
                    }

                }else{
                    return redirect('admin/withdraw/create')->with('message', 'insufficient balance ');
                }

               }else{
                return redirect('admin/withdraw/create')->with('message', 'Your password is wrong');
               }
            }

        }else{
            return redirect('admin/withdraw/create')->with('message', 'You can not withdraw less than '.$settingData->min_balance.' taka');
        }

       }

       public function acceptWithdraw(Request $request)
       {

        $user_id = \Auth::user()->id;
        $type = \Auth::user()->type;
        $currentDate = date('Y-m-d');

         $data = Withdraw::where('id',$request->withdrwa_id)->first();
         if($data->extra_charge == 0){
            $final_amount = $data->final_amount - $request->extra_charge;

            $data->update(['status'=> 1, 'approved_by'=> $user_id,'approved_date'=> $currentDate,'note'=>$request->note,'extra_charge'=>$request->extra_charge,'final_amount'=>$final_amount]);
         }


         return redirect('admin/withdraw/index')->with('message', 'Accept withdraw successful');
        // return $this->index();
    }
    
    
       public function rejectwithdraw(Request $request)
       {

        $user_id = \Auth::user()->id;
        $type = \Auth::user()->type;
        $currentDate = date('Y-m-d');

         $data = Withdraw::where('id',$request->withdrwa_id)->first();
         if($data->extra_charge == 0){
            $final_amount = $data->final_amount - $request->extra_charge;

            $data->update(['status'=> 0, 'approved_by'=> $user_id,'approved_date'=> $currentDate,'note'=>$request->note,'extra_charge'=>$request->extra_charge,'final_amount'=>$final_amount]);
         }


         return redirect('admin/withdraw/index')->with('message', 'Accept withdraw successful');
        // return $this->index();
    }
        
    
    
}