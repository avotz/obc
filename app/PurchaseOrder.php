<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'transaction_id','user_id', 'file', 'comments','geo_type','status'
    ];

    public function generateTransactionId(){
        
        $transactions = $this->where('quotation_id', $this->quotation_id)->count();
       
        $this->transaction_id = 'Purchase Order '. $this->quotation_id;

        $purchase = $this->save();

        return $purchase;
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
    
}
