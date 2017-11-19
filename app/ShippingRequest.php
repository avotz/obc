<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShippingRequest extends Model
{
    protected $fillable = [
        'transaction_id','user_id', 'file', 'comments','date','delivery_time'
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
       
        $this->transaction_id = 'Shipping Request '. $this->id;

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
     public function suppliers()
    {
        return $this->belongsToMany(Company::class,'shipping_request_supplier', 'request_id', 'supplier_id');
    }
     public function shippings()
    {
        return $this->hasMany(Shipping::class);
    }
}
