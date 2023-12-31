<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use DB;
use App\Models\Stockiest;
use App\Models\Purchase;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile',
        'login_type',
        'referral_code',
        'type',
        'slug',
        'otp',
        'profile_pic',
        'is_verified',
        'is_available',
        'google_id',
        'facebook_id',
        'wallet',
        'stockiest_status',
        'vendor_status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function rattings(){
        return $this->hasMany('App\Models\Ratting','vendor_id','id')->select('vendor_id',DB::raw('ROUND(AVG(ratting),1) as avg_ratting'))->groupBy('vendor_id');
    }

    public function stockiest()
    {
       return $this->hasOne(Stockiest::class, 'user_id', 'id');
    }

    public function purchase()
    {
       return $this->hasMany(Purchase::class, 'user_id','id');
    }
    public function userInformation(){
        return $this->hasOne(UserInformation::class, 'user_id', 'id');
    }
}