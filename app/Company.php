<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'company_name', 'identification_number', 'phones','physical_address','country','towns','web_address','legal_name','legal_first_surname','legal_second_surname','legal_email'
    ];
   
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
