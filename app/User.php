<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'activity', 'email', 'password','private_code', 'active'
    ];

    protected $appends = array('public_code');
    
    
    
        public function getPublicCodeAttribute()
        {
            // foreach($this->company->countries as $country)
            // {
            //     $countriesCodes[] = $country->code;
            // }
            // $countries= implode('|',  $countriesCodes);

            return trans('utils.activity.'.$this->activity) . ' '. zerofill($this->id,3);
        }
       
         
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * A user may have multiple roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
     public function roles()
     {
         return $this->belongsToMany(Role::class);
     }
 
     /**
      * Assign the given role to the user.
      *
      * @param  string $role
      * @return mixed
      */
     public function assignRole($role)
     {
         if (is_object($role)) {
             return $this->roles()->attach($role);
        
         }
        
         return $this->roles()->sync($role);
        
     }
 
     /**
      * Determine if the user has the given role.
      *
      * @param  mixed $role
      * @return boolean
      */
     public function hasRole($role)
     {
         if (is_string($role)) {
             return $this->roles->contains('name', $role);
         }
 
         return !! $role->intersect($this->roles)->count();
     }
 

    public function partners()
    {
        return $this->belongsToMany(User::class, 'partner_user', 'user_id', 'partner_id');
    }
    public function addPartner(User $user)
    {
        $this->partners()->attach($user->id);
    }

    public function removePartner(User $user)
    {
        $this->partners()->detach($user->id);
    }
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
    public function company()
    {
        return $this->hasOne(Company::class);
    }

    public function toArray()
    {
        return [
            
            'email' => $this->email,
            'company' => $this->company
        ];
    }
}
