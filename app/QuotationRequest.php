<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuotationRequest extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'transaction_id','delivery_time', 'way_of_delivery', 'way_to_pay','exp_date', 'comments' ,'geo_type','product_name','product_photo','public'
    ];

    public function generateTransactionId(){
        
       
        $this->transaction_id = 'Quotation Request -'. $this->id;

        $quotationRequest = $this->save();

        return $quotationRequest;
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function quotations()
    {
        return $this->hasMany(Quotation::class, 'request_id');
    }
    public function suppliers()
    {
        return $this->belongsToMany(Company::class,'request_supplier', 'request_id', 'supplier_id');
    }
    public function sectors()
    {
        return $this->belongsToMany(Sector::class,'request_sector', 'request_id', 'sector_id');
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
      public function createdBy($user)
      {
         
          return $this->where('user_id',$user->id)->first();
      }
}
