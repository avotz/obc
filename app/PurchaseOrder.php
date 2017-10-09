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
        
        $transactions = $this->where('request_id', $this->request_id)->count();
       
        $this->transaction_id = 'Quotation '. $this->request_id.'-'.$transactions++;

        $user = $this->save();

        return $user;
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
