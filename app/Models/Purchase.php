<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $fillable =[
        'user_id',
        'due_date',
        'tax',
        'vat',
        'invoice_id',
        'load_unload',
        'note',
        'method',
        'payment_by',
        'card_phone_number',
        'discount',
        'amount',
        'sub_total',
    ];

    public function purchaseDetails()
    {
        return $this->hasMany(PurchaseDetails::class,'purchase_id', 'id' )->with('product');
    }
    public function user()
    {
       return $this->belongsTo(User::class, 'user_id');
    }
}
