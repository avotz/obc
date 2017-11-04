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
        'transaction_id','user_id', 'file', 'comments','cost','date','delivery_time'
    ];

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
        return $this->belongsToMany(User::class,'shipping_supplier', 'shipping_id', 'supplier_id');
    }
}
