<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'applicant_name', 'first_surname', 'second_surname','position_held','phone'
    ];
   
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
