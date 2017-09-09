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
    public function countries()
    {
        return $this->belongsToMany(Country::class);
    }
    public function sectors()
    {
        return $this->belongsToMany(Sector::class);
    }
     /**
      * Determine if the user has the given role.
      *
      * @param  mixed $role
      * @return boolean
      */
      public function hasSector($sector)
      {
          if (is_string($sector) || is_numeric($sector)) {
              return $this->sectors->contains('id', $sector);
          }
  
          return !! $sector->intersect($this->sectors)->count();
      }
}
