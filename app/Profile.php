<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'applicant_name', 'first_surname', 'second_surname','position_held','phone'
    ];

    protected $appends = array('fullname');

    public function getFullnameAttribute()
    {
        return $this->applicant_name. ' ' .$this->first_surname. ' '. $this->second_surname;  
    }
   
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
