<?php
namespace App\Helpers;
use App\Models\Settings;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Payout;
use App\Models\Bank;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Innersubcategory;
use App\Models\Banner;
use App\Models\Help;
use App\Models\Products;
use App\Models\AchieveIncentive;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Str;
use URL;

class Helper{

    public static function forgotpassword($email, $name, $password)
    {
        $data = [
            'title' => trans('messages.password_reset'),
            'email' => $email,
            'name' => $name,
            'password' => $password,
            "logo"=>Helper::webinfo()->image
        ];
        try {
            Mail::send('Email.email', $data, function ($message) use ($data) {
                $message->from(env('MAIL_USERNAME'))->subject($data['title']);
                $message->to($data['email']);
            });
            return 1;
        } catch (\Throwable $th) {
            // dd($th->getMessage());
            return 0;
        }
    }

    public static function push_notification($title,$body,$token)
    {
        $firebase_key=Settings::select('firebase_key')->first();
        $google_api_key = $firebase_key->firebase_key;

       #prep the bundle
       $msg = array(
           'body'  => $body,
           'title' => $title,
           'sound' => 1/*Default sound*/
           );
       $fields = array(
           'to'            => $token,
           'notification'  => $msg
           );
       $headers = array(
           'Authorization: key=' . $google_api_key,
           'Content-Type: application/json'
           );
       #Send Reponse To FireBase Server
       $ch = curl_init();
       curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
       curl_setopt( $ch,CURLOPT_POST, true );
       curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
       curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
       curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
       curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );

       $result = curl_exec ( $ch );
       curl_close ( $ch );
       return $result;
    }

    public static function CurrencyFormatter($money)
    {

        $currency=Settings::select('currency','currency_position')->first();

        if ($currency->currency_position == "left") {
            return $currency->currency . number_format($money, 2);
        }
        if ($currency->currency_position == "right") {
            // dd($currency->currency);
            // dd(number_format($money, 2));
            return number_format($money, 2) . $currency->currency;
        }
    }

    public static function getcart($user_id)
    {

        $cart=Cart::select('id','product_id','product_name','qty','price','variation','attribute',\DB::raw("CONCAT('".url('/storage/app/public/images/products/')."/', image) AS image_url"))
        ->where('user_id', $user_id)
        ->orderBy('id', 'DESC')
        ->get();

        return $cart;
    }

    // public static function getwalletbalance($user_id)
    // {

    //     $walletbalance=User::select('wallet')
    //     ->where('id', $user_id)
    //     ->first();
    //     if ($walletbalance->wallet != "") {
    //         $balance = $walletbalance->wallet;
    //     } else {
    //         $balance = "";
    //     }
    //     return self::CurrencyFormatter($balance);
    // }
    
    public static function getwalletbalance($user_id, $formate = true)
    {

        $walletbalance=User::select('wallet')
        ->where('id', $user_id)
        ->first();
        if ($walletbalance->wallet != "") {
            $balance = $walletbalance->wallet;
        } else {
            $balance = "";
        }
        if($formate){
           return self::CurrencyFormatter($balance); 
        }
        return $balance;
    }    
    public static function getCashWallet($user_id)
    {
        $type = \Auth::user()->type;
        $walletbalance=User::select('cash_wallet')
        ->where('id', $user_id)
        ->where('type', 1)
        ->first();
        // dd($walletbalance,$user_id,$type);
        if ($walletbalance->cash_wallet != "") {
            $balance_is = $walletbalance->cash_wallet;
        } else {
            $balance_is = "";
        }
        return self::CurrencyFormatter($balance_is);
    }

    public static function UpdateVendorWallet($id,$vendor_id)
    {
        $status=Order::select('order_total','vendor_id')
        ->where('id',$id)
        ->first();

        $getvendordata=User::select('wallet')
        ->where('id',$status->vendor_id)
        ->first();

        if ($getvendordata->wallet > 0) {
            $vendorwallet = $getvendordata->wallet + $status->order_total;
        } elseif ($getvendordata->wallet < 0) {
            $vendorwallet = $getvendordata->wallet + $status->order_total;
        } else {
            $vendorwallet = 0;
        }

        $vendorwallet = User::where('id', $status->vendor_id)
        ->update(['wallet' => $vendorwallet]);

        return $vendorwallet;
    }

    public static function ReturnOrderCount($vendor_id)
    {
        $orders=Order::select('order_total','vendor_id')
        ->where('vendor_id',$vendor_id)
        ->where('status','7')
        ->count();

        return $orders;
    }

    public static function checkStar()
    {
        $data['referralCode'] = $referralCode = \Auth::user()->referral_code;
        $user_id = \Auth::user()->id;
        $name = \Auth::user()->name;
        $date = date("Y/m/d");
        // dd($referralCode);
        $data['first'] = $firsts =User::where('refferal_vendor',$referralCode)->selectRaw('id, refferal_vendor, referral_code')->get();


        $data['second'] =  $seconds = \DB::select('SELECT * FROM `users` WHERE `refferal_vendor` in (
                           SELECT referral_code FROM `users` WHERE `refferal_vendor`="'.$referralCode.'")');

        $data['third'] = $thirds =\DB::select('SELECT * FROM `users` WHERE `refferal_vendor` in (
                        SELECT referral_code FROM `users` WHERE `refferal_vendor` in (
                        SELECT referral_code FROM `users` WHERE `refferal_vendor`="'.$referralCode.'"))');
        //   dd($data);
        $second_gen_1star =[];
            foreach($firsts as $index=>$first){
                // dd($sec->referral_code);
               $second_gen_1star[$index] = User::where('refferal_vendor',$first->referral_code)->selectRaw('id, refferal_vendor, referral_code')->get();
            }
             $check_second_start_count = 0;
            foreach($seconds as $ind=>$second){
                // dd($sec->referral_code);
               $third_gen_1star[$ind] = User::where('refferal_vendor',$second->referral_code)->selectRaw('id, refferal_vendor, referral_code')->get();

               $check_second_star = AchieveIncentive::where('user_id', $second->id)->where('incentive_id', 2)->select('incentive_id')->orderBy('created_at', 'desc')
               ->limit(1)->first();

               if($check_second_star){
                $check_second_start_count++;
               }

            }

            $total_refer = (count($firsts)+ count($seconds) + count($thirds));

            $checkIncentive = AchieveIncentive::where('user_id', $user_id)->select('incentive_id')->orderBy('created_at', 'desc')
            ->limit(1)->first();
            //  $checkIncentive

            foreach($seconds as $ind=>$second){
                // dd($sec->referral_code);
               $third_gen_1star[$ind] = User::where('refferal_vendor',$second->referral_code)->selectRaw('id, refferal_vendor, referral_code')->get();
            }

        //    dd($checkIncentive->incentive_id);
        if(!empty($checkIncentive)){
            $incentive_id = $checkIncentive->incentive_id;
        }else{
            $incentive_id =  null;
        }

        //    dd($incentive_id);
           if(count($firsts)>=10){

             if($incentive_id == 2){
                AchieveIncentive::create([
                    'user_id' => $user_id,
                    'incentive_id' => 1,
                    'title' => '1st Star',
                    'name' => $name,
                    'achieve_date' => $date,
                ]);
             }else if($incentive_id == null){
                AchieveIncentive::create([
                    'user_id' => $user_id,
                    'incentive_id' => 1,
                    'title' => '1st Star',
                    'name' => $name,
                    'achieve_date' => $date,
                ]);
             }

            }
            // else if(count($firsts) >3 && $total_refer >= 10 ){
            else if(count($second_gen_1star)>=10){

                 $second_star_count =0;

                foreach($second_gen_1star as $in =>$second_gen){
                    if(count($second_gen)>=10){
                        $second_star_count++;
                    }
                 }

                if($incentive_id == 1 && $second_star_count >=10){
                    // dd('gggggggggg');
                    AchieveIncentive::create([
                        'user_id' => $user_id,
                        'incentive_id' => 2,
                        'title' => '2nd Star',
                        'name' => $name,
                        'achieve_date' => $date,
                    ]);
                 }else if($incentive_id == null && $second_star_count >=10){
                    AchieveIncentive::create([
                        'user_id' => $user_id,
                        'incentive_id' => 2,
                        'title' => '2nd Star',
                        'name' => $name,
                        'achieve_date' => $date,
                    ]);
                 }
            }
             else if($check_second_start_count>=3){

                if($incentive_id == 1 || $incentive_id == 2){
                    // dd('gggggggggg');
                    AchieveIncentive::create([
                        'user_id' => $user_id,
                        'incentive_id' => 3,
                        'title' => '3rd Star',
                        'name' => $name,
                        'achieve_date' => $date,
                    ]);
                 }else if($incentive_id == null){
                    AchieveIncentive::create([
                        'user_id' => $user_id,
                        'incentive_id' => 3,
                        'title' => '3rd Star',
                        'name' => $name,
                        'achieve_date' => $date,
                    ]);
                 }
            }

    //   dd($check);

    $data['check_start'] = AchieveIncentive::where('user_id', $user_id)->select('incentive_id')->orderBy('created_at', 'desc')
            ->limit(1)->first();

        return $data;
    }

    public static function NewOrderCount($vendor_id)
    {
        $orders=Order::select('order_total','vendor_id')
        ->where('vendor_id',$vendor_id)
        ->where('status','1')
        ->groupBy('order_number')
        ->count();

        return $orders;
    }
    public static function TotalNewOrderCount()
    {
        $orders=Order::select('order_total','vendor_id')
        ->where('status','1')
        ->groupBy('order_number')
        ->count();

        return $orders;
    }

    public static function PayoutRequest()
    {
        $payoutrequest=Payout::where('status','1');
        if(@Auth::user()->type == 3){
            $payoutrequest = $payoutrequest->where('vendor_id',@Auth::user()->id);
        }
        $payoutrequest = $payoutrequest->count();
        return $payoutrequest;
    }

    public static function MinBalanceForWithdraw($user_id)
    {

        $walletbalance=User::select('wallet')
        ->where('id', $user_id)
        ->first();
        if ($walletbalance->wallet > 0) {
            $balance = $walletbalance->wallet;
        } else {
            $balance = 0;
        }

        $minbalance=Settings::select('min_balance')->first();

        if ($balance >= $minbalance->min_balance) {
            $display = 1;
        } else {
            $display = 0;
        }

        return $display;
    }

    public static function CheckInfo($user_id)
    {

        $bankdetails=Bank::where('vendor_id', $user_id)->first();
        if (empty($bankdetails)) {
            $info = 1;
        } else {
            $info = 0;
        }

        return $info;
    }

    public static function getCategory()
    {

        $categories=Category::select('id','category_name','slug',\DB::raw("CONCAT('".url('/storage/app/public/images/category/')."/', icon) AS image"))
        ->where('status','1')
        ->get();

        return $categories;
    }

    public static function getSubcategory()
    {

        $subcategory=Subcategory::select('id','cat_id','subcategory_name','slug')
        ->where('status','1')
        ->get();

        return $subcategory;
    }

    public static function InnerSubcategory()
    {

        $innersubcategory=Innersubcategory::select('id','cat_id','subcat_id','innersubcategory_name','slug')
        ->where('status','1')
        ->get();

        return $innersubcategory;
    }

    public static function webinfo()
    {

        $webinfo=Settings::select(\DB::raw("CONCAT('".url('/storage/app/public/images/settings/')."/', logo) AS image"),\DB::raw("CONCAT('".url('/storage/app/public/images/settings/')."/', favicon) AS favicon"),'copyright','address','distribute_amount','contact','email','site_title','meta_title','meta_description',\DB::raw("CONCAT('".url('/storage/app/public/images/settings/')."/', og_image) AS og_image"),'facebook','twitter','instagram','linkedin')
        ->first();

        return $webinfo;
    }

    public static function loginUser()
    {


        $loginUser = User::findOrFail(@Auth::user()->id);

        return $loginUser;
    }

    public static function Help()
    {
        $help=Help::where('status','1')
        ->count();

        return $help;
    }

    public static function date_format($date)
    {
        $date = date('d-m-Y', strtotime($date));
        return $date;
    }

    public static function homebanner()
    {

        $banners=Banner::select('id','type','cat_id','product_id',\DB::raw("CONCAT('".url('/storage/app/public/images/banner/')."/', image) AS image"))
        ->where('positions','popup')
        ->first();

        return $banners;
    }

    public static function getSlug($type,$id)
    {
        $slug = "#";
        if ($type == 'category') {
            $data=Category::select('slug')->where('id',$id)->first();
            $slug = URL::to('categories/products/'.@$data->slug);
        }
        if ($type == 'product') {
            $data=Products::select('slug')->where('id',$id)->first();
            $slug = URL::to('products/product-details/'.@$data->slug);
        }
        return $slug;
    }
    public static function image_path($image)
    {
        $path = asset('storage/app/public/images/not-found.png');

        if(Str::contains($image, 'default')){
            $path = asset('storage/app/public/images/users/'.$image);
        }
        if(Str::contains($image, 'category')){
            $path = asset('storage/app/public/images/category/'.$image);
        }
        if(Str::contains($image, 'brand')){
            $path = asset('storage/app/public/images/brand/'.$image);
        }
        if(Str::contains($image, 'slider')){
            $path = asset('storage/app/public/images/slider/'.$image);
        }
        if(Str::contains($image, 'logo') || Str::contains($image, 'favicon') || Str::contains($image, 'og_image')){
            $path = asset('storage/app/public/images/settings/'.$image);
        }
        if(Str::contains($image, 'largebanner-') || Str::contains($image, 'leftbanner-') || Str::contains($image, 'storebanner-') || Str::contains($image, 'banner-') || Str::contains($image, 'popupbanner-') ||Str::contains($image, 'topbanner-') ){
            $path = asset('storage/app/public/images/banner/'.$image);
        }
        if(Str::contains($image, 'placed') || Str::contains($image, 'confirmed') || Str::contains($image, 'delivery') || Str::contains($image, 'delivered') || Str::contains($image, 'cancel') ||Str::contains($image, 'cancel') ){
            $path = asset('storage/app/public/Webassets/img/'.$image);
        }
        if(Str::contains($image, 'profile')){
            $path = asset('storage/app/public/images/profile/'.$image);
        }
        if(Str::contains($image, 'no-data')){
            $path = asset('storage/app/public/images/'.$image);
        }

        return $path;
    }
    public static function emailverification($email,$otp)
    {
        $title=trans('labels.email_verification');
        $data=['title'=>$title,'email'=>$email,'otp'=>$otp,"logo"=>Helper::webinfo()->image];

        try {
            Mail::send('Email.emailverification',$data,function($message)use($data){
                $message->from(env('MAIL_USERNAME'))->subject($data['title']);
                $message->to($data['email']);
            } );
            return 1;
        } catch (\Throwable $th) {
            return 0;
        }

   }
}
