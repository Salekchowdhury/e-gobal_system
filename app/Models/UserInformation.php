<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInformation extends Model
{
    use HasFactory;
    protected $table ='user_informations';
    protected $fillable = [
        'user_id','gender','father_name','mother_name','guardian_number','nid','permanent_address','current_address'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}