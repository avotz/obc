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
        'activity', 'email', 'password','private_code', 'public_code' ,'active'
    ];

    
    /*protected $appends = array('public_code','usr_public_code');
    
    
    
    public function getPublicCodeAttribute()
    {
        // foreach($this->company->countries as $country)
        // {
        //     $countriesCodes[] = $country->code;
        // }
        // $countries= implode('|',  $countriesCodes);

        return trans('utils.activity.'.$this->activity) . ' '. zerofill($this->id,3);
    }
    public function getUsrPublicCodeAttribute()
    {
        // foreach($this->company->countries as $country)
        // {
        //     $countriesCodes[] = $country->code;
        // }
        // $countries= implode('|',  $countriesCodes);

        return 'USR-'. zerofill($this->id,3);
    }*/

    public function generatePublicCode(){
        
        if( $this->hasRole('partner')){
            $this->public_code = trans('utils.activity.'.$this->activity) . ' '. zerofill($this->id,3).'-'.$this->company->countries->first()->code;
        }else
            $this->public_code = 'USR-'. zerofill($this->id,3);

        $user = $this->save();

        return $user;
    }

       
         
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function scopeSearch($query, $search)
    {
        if($search){

            return $query->where(function ($query) use ($search)
            {
                $query->where('public_code', 'like', '%'. $search .'%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhereHas('profile' , function ($query) use ($search){
                        $query->where('applicant_name', 'like', '%' . $search . '%');
                      });
                
            });
        }

        return $query;
    }

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
    
     public function requests()
     {
         return $this->hasMany(QuotationRequest::class);
     }
     public function quotations()
     {
         return $this->hasMany(Quotation::class);
     }
    public function requests_suppliers()
    {
         return $this->belongsToMany(QuotationRequest::class);
    }
    public function partners() //associates
    {
        return $this->belongsToMany(User::class, 'partner_user', 'user_id', 'partner_id');
    }
    public function collaborators() //users
    {
        return $this->belongsToMany(User::class, 'partner_user', 'partner_id', 'user_id');
    }
    
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
    public function company()
    {
        return $this->hasOne(Company::class);
    }
    public function countries() //users
    {
        return $this->belongsToMany(Country::class);
    }
    /**
     * A role may be given various permissions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
     public function permissions()
     {
         return $this->belongsToMany(Permission::class);
     }
 
     /**
      * Grant the given permission to a role.
      *
      * @param  Permission $permission
      * @return mixed
      */
     public function givePermissionTo(Permission $permission)
     {
         return $this->permissions()->save($permission);
     }
     /**
     * Determine if the user may perform the given permission.
     *
     * @param  Permission $permission
     * @return boolean
     */
    public function hasPermission($permission)
    {
        
        if (is_string($permission)) {
            return $this->permissions->contains('name', $permission);
        }

        return !! $permission->intersect($this->permissions)->count();
       
    }

    public function addPartner(User $user)
    {
        $this->partners()->attach($user->id);
        
    }

    public function removePartner(User $user)
    {
        $this->partners()->detach($user->id);
       
    }

    public function toArray()
    {
        return [
            
            'email' => $this->email,
            'company' => $this->company
        ];
    }
}
