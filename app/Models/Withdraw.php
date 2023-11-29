<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    use HasFactory;
    protected $fillable =[
      'user_id',
      'amount',
      'commission',
      'final_amount',
      'withdraw_date',
      'mobile_number',
      'payment_type',
      'bank_list_id',
      'account_name',
      'account_number',
      'branch_name',
      'status',
      'city',
      'routin_number',
      'extra_charge',
      'note',
      'approved_date',

    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'approved_by', 'id');
    }
     public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function bankList()
    {
        return $this->belongsTo(BankList::class, 'bank_list_id', 'id');
    }
}