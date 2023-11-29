<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\User;
use App\Models\UserInformation;
use App\Models\AchieveIncentive;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=User::where('type','2')->orderBy('id', 'DESC')->get();
        return view('Admin.users.index',compact('data'));
    }

    public static function test()
    {
        $data = User::get();
        return $data;

    }

    public function profile()
    {
        $id = \Auth::user()->id;
         $data['profile'] = User::where('id',$id)->with('userInformation')->first();

        // dd($data);
        return view('Admin.profile.profile',$data);
    }

    public function updateProfile(Request $request){
    //    dd($request->all());
    $id = \Auth::user()->id;
    $request->validate([
        'name' => 'required',
        'email' => 'required',
        'mobile' => 'required',
        'current_address' => 'required',
        'nid' => 'required|min:10',
    ]);
    $user_data= User::where('id',$id)->first();
    $unser_info_inputs = $request->all();
    $unser_info_inputs['user_id'] = $id;
    $profile_pic = $user_data->profile_pic;

    if($request->hasFile('profile_pic')){
        $file = $request->file('profile_pic');
        $ext = $file->getClientOriginalExtension();
        $fileName = time().'.'.$ext;

        $file->move('storage/app/public/images/profile', $fileName);
        // $file->move('images\users', $fileName);
        $profile_pic = $fileName;
     }


     $user = UserInformation::where('user_id',$id)->first();

          $user_data->update([
                'name'=>$request->name,
                'profile_pic'=>$profile_pic,
            ]);

     if($user){
        $user->update([
         'nid'=>$request->nid,
         'gender'=>$request->gender,
         'father_name'=>$request->father_name,
         'mother_name'=>$request->mother_name,
         'guardian_number'=>$request->guardian_number,
         'permanent_address'=>$request->permanent_address,
         'current_address'=>$request->current_address,
        ]);
     }else{
        UserInformation::create($unser_info_inputs);
     }
     return back()->with('message', 'Profile Updated');
    }
     public function UserReferral()
    {

        $referralCode = \Auth::user()->referral_code;
        // dd($referralCode);
        $referrals =User::where('refferal_vendor',$referralCode)->selectRaw('id, refferal_vendor, referral_code')->get();

        // start * work

        // end * work
        $totalMember = count($referrals);
        // dd($referrals);
        $users = [];
        $count = 0;
        $third_label = [];
        foreach ($referrals as $key => $value) {
            array_push($users , User::where('refferal_vendor',$value->referral_code)->get()) ;
        }
        foreach($users as $user){
            // dd($user);
            foreach($user as $data){

                // $third_label = User::where('refferal_vendor',$data->referral_code)->get();
                array_push($third_label , User::where('refferal_vendor',$data->referral_code)->get()) ;
                // dd($third);
            }

        }
        $user_feferral = User::where('refferal_vendor',$referralCode)->selectRaw('count(*) as member, refferal_vendor, referral_code')->get();
        //  dd($users,$totalMember,$user_feferral,$users,$third_label);
        // dd($count);
        return view('Admin.referral.index', compact('user_feferral','users','third_label'));
    }

        public function incentive()
        {

            // dd($datas);
            return view('Admin.incentive.list');
        }

    public function changeStatus(Request $request)
    {
        $this->validate($request,[
            'id' => 'required',
            'status' => 'required',
        ]);

        $data['is_available']=$request->status;
        User::where('id',$request->id)->update($data);
        if ($data) {
            return 1000;
        } else {
            return 2000;
        }
    }

    public function refferralSearch(Request $request)
    {
        // return $request->referral_code;

        $data = User::where('refferal_vendor',$request->referral_code)->get();

        return response()->json([

            'status'=> 200,
            'data'=> $data,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $data=User::where('name', 'LIKE', '%' . $request->search . '%')->where('type','2')->orderBy('id', 'DESC')->paginate(10);
        return view('Admin.users.index',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view(Request $request)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

    }
}