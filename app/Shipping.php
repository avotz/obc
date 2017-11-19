<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'transaction_id','user_id','quotation_id','shipping_request_id', 'file', 'comments','cost','date','delivery_time'
    ];

    public function scopeSearch($query, $search)
    {
        if($search){

            return $query->where(function ($query) use ($search)
            {
                $query->where('transaction_id', 'like', '%'. $search .'%');
                    /*->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhereHas('profile' , function ($query) use ($search){
                        $query->where('applicant_name', 'like', '%' . $search . '%');
                      });*/
                
            });
        }

        return $query;
    }

    public function generateTransactionId(){
        
        //$transactions = $this->where('quotation_id', $this->quotation_id)->count();
       
        $this->transaction_id = 'Shipping '. $this->id;

        $shipping = $this->save();

        return $shipping;
    }

    public function isPending()
    {
        return $this->status == 0;
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    
    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }
    public function shippingRequest()
    {
        return $this->belongsTo(ShippingRequest::class,'shipping_request_id');
    }
      public function suppliers()
    {
        return $this->belongsToMany(Company::class,'shipping_supplier', 'shipping_id', 'supplier_id');
    }
    
}
