<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'company_name', 'identification_number', 'phones','physical_address','country','towns','web_address','legal_name','legal_first_surname','legal_second_surname','legal_email','private_code','activity','public_code'
    ];

    public function scopeSearch($query, $search)
    {
        if($search){

            return $query->where(function ($query) use ($search)
            {
                $query->where('public_code', 'like', '%'. $search .'%')
                    ->orWhere('company_name', 'like', '%' . $search . '%');
                    /*->orWhereHas('profile' , function ($query) use ($search){
                        $query->where('company_name', 'like', '%' . $search . '%');
                      });*/
                
            });
        }

        return $query;
    }
    public function generatePublicCode(){
        
      
        $this->public_code = trans('utils.activity.'.$this->activity) . ' '. zerofill($this->id,3).'-'.$this->countries->first()->code;
       

        $company = $this->save();

        return $company;
    }
   
    public function users()
    {
        return $this->belongsToMany(User::class);
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
    
        /**
      * Determine if the user has the given role.
      *
      * @param  mixed $role
      * @return boolean
      */
      public function isPartner($user)
      {
          if (is_string($user) || is_numeric($user)) {
              return $this->users->contains('id', $user);
          }
  
          return $user->companies()->where('company_id', $this->id)->count();

        // return $this->companies()->where('user_id', $user->id)->count();
  
      }
}
