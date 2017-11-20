<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'transaction_id','user_id','quotation_id','credit_request_id', 'file', 'comments','amount','date','approval_date','payment_date','interest','total','credit_time'
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
       
        $this->transaction_id = 'Credit '. $this->id;

        $credit = $this->save();

        return $credit;
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
    public function creditRequest()
    {
        return $this->belongsTo(CreditRequest::class,'credit_request_id');
    }
    /*  public function suppliers()
    {
        return $this->belongsToMany(Company::class,'credit_supplier', 'credit_id', 'supplier_id');
    }*/
}
