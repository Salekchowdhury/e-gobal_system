<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AchieveIncentive;
use App\Models\User;
use App\Models\DistributeFundAmount;
use App\Models\RankWiseDistribution;

class AchieveIncentiveController extends Controller
{
       public function index(){
        //   dd('ll');
        $users = User::where('type',3)->where('rank',0)->get();
        //  dd(count($users));
        $date = date("Y/m/d");

        for($i=0;$i<=2;$i++){

            $title = $i+1 .'Star';

            foreach($users as $index=>$user){
                               $check_star = User::where('refferal_vendor',$user->referral_code)->where('rank',$i)->count();
                            //    echo " ".$check_star;
                if($i !=2){
                   
                    if($check_star >= 10){

                        $data= User::find($user->id);
                        $data->update(['rank'=>$i+1]);
                        $checkIncentive = AchieveIncentive::where('user_id', $user->id)->select('incentive_id')->orderBy('created_at', 'desc')
                        ->limit(1)->first();
                        if($checkIncentive){
                          $checkIncentive->update([
                              'user_id' => $user->id,
                              'incentive_id' => $i+1,
                              'title' => '1 Star',
                              'name' => $user->name,
                              'achieve_date' => $date,
                          ]);
                        }else{
                          AchieveIncentive::create([
                              'user_id' => $user->id,
                              'incentive_id' => 1,
                              'title' => '1 Star',
                              'name' => $user->name,
                              'achieve_date' => $date,
                          ]);
                        }
                     }
                }else{
                    // dd('ll');
                    if($check_star >= 3){
                        $data= User::find($user->id);
                        $data->update(['rank'=>$i+1]);
                        $checkIncentive = AchieveIncentive::where('user_id', $user->id)->select('incentive_id')->orderBy('created_at', 'desc')
                        ->limit(1)->first();
                        if($checkIncentive){
                          $checkIncentive->update([
                              'user_id' => $user->id,
                              'incentive_id' => $i+1,
                              'title' => $title,
                              'name' => $user->name,
                              'achieve_date' => $date,
                          ]);
                        }else{
                          AchieveIncentive::create([
                              'user_id' => $user->id,
                              'incentive_id' => 1,
                              'title' => $title,
                              'name' => $user->name,
                              'achieve_date' => $date,
                          ]);
                        }
                     }
                }

            }
        }

        $checkType = Auth()->user()->type;
        $id = Auth()->user()->id;

        // dd($checkType == 1);

        if($checkType == 1){
            $datas = AchieveIncentive::with('user')->get();
            return view('Admin.rankHistory.list',compact('datas'));
        }else if($checkType == 3){

            $datas = AchieveIncentive::where('user_id', $id)->get();
            return view('Admin.rankHistory.list',compact('datas'));
        }


       }

       function rankDistributeFund (){

        $data['datas']= RankWiseDistribution::with('user')->get();
        // dd($data);
        return view('Admin.rankHistory.rank_wise_distribution',$data);
       }

       function rankWiseDistributeFund(Request $request) {
        $date = date("Y/m/d");
          $first_star = DistributeFundAmount::where('fund_title','1st Star')->whereDate('created_at', '>=', $request->from_date)
          ->whereDate('created_at', '<=', $request->to_date)->select(\DB::raw("SUM(amount) as total_amount"))->first();

          $second_star = DistributeFundAmount::where('fund_title','2nd Star')->whereDate('created_at', '>=', $request->from_date)
          ->whereDate('created_at', '<=', $request->to_date)->select(\DB::raw("SUM(amount) as total_amount"))->first();

          $third_star = DistributeFundAmount::where('fund_title','3rd Star')->whereDate('created_at', '>=', $request->from_date)
          ->whereDate('created_at', '<=', $request->to_date)->select(\DB::raw("SUM(amount) as total_amount"))->first();

            // dd($first_star->total_amount, $second_star->total_amount,$third_star->total_amount);
           $rank_first = AchieveIncentive::where('incentive_id',1)->whereDate('created_at', '>=', $request->from_date)
           ->whereDate('created_at', '<=', $request->to_date)->get();
           $rank_second = AchieveIncentive::where('incentive_id',2)->whereDate('created_at', '>=', $request->from_date)
           ->whereDate('created_at', '<=', $request->to_date)->get();
           $rank_third = AchieveIncentive::where('incentive_id',3)->whereDate('created_at', '>=', $request->from_date)
           ->whereDate('created_at', '<=', $request->to_date)->get();

        //    dd($rank_first,count($rank_second),$rank_third);


        if(count($rank_first)>0){
               $first_star_amount =  ($first_star->total_amount)/count($rank_first);
               foreach($rank_first as $rank_f){
                       $input_first['user_id']=$rank_f->user_id;
                       $input_first['amount']=$first_star_amount;
                       $input_first['generate_date']= $date;
                       $input_first['rank']= 1;
                      $status = RankWiseDistribution::create($input_first);
                      if($status){
                        $user = User::find($rank_f->user_id);
                        $amount = $user->wallet;
                        // dd($amount);
                        $updatePrice = ($amount + $first_star_amount);
                        \DB::table('users')
                            ->where('id', $rank_f->user_id)
                            ->update(['wallet' => $updatePrice]);
                      }

                }

           }

           if(count($rank_second)>0){
               $second_star_amount =  ($first_star->total_amount)/count($rank_second);
               foreach($rank_second as $rank_s){
                $input_second['user_id']=$rank_s->user_id;
                $input_second['amount']=$second_star_amount;
                $input_second['generate_date']= $date;
                $input_second['rank']= 2;
               $status = RankWiseDistribution::create($input_second);

                if($status){
                 $user = User::find($rank_s->user_id);
                //  dd($user->wallet);
                 $amount = $user->wallet;
                 $updatePrice = ($amount + $second_star_amount);
                 \DB::table('users')
                     ->where('id', $rank_s->user_id)
                     ->update(['wallet' => $updatePrice]);
               }
             }

           }

           if(count($rank_third)>0){
            $third_star_amount =  ($first_star->total_amount)/count($rank_third);

               foreach($rank_third as $rank_t){
                $input_third['user_id']=$rank_t->user_id;
                $input_third['amount']=$third_star_amount;
                $input_third['generate_date']= $date;
                $input_third['rank']= 3;
                $status = RankWiseDistribution::create($input_third);

                if($status){
                 $user = User::find($rank_t->user_id);
                 $amount = $user->wallet;
                 // dd($amount);
                 $updatePrice = ($amount + $third_star_amount);
                 \DB::table('users')
                     ->where('id', $rank_t->user_id)
                     ->update(['wallet' => $updatePrice]);
               }
         }

           }

         return redirect()->back();
       }
}