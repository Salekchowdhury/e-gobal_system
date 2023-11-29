<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistributeFundAmount extends Model
{
    use HasFactory;
    protected $fillable =[
         'fund_distribution_id',
         'fund_title',
         'order_id',
         'order_number',
         'vendor_id',
         'vendor_name',
         'amount',
         'distribution_status',
    ];
}