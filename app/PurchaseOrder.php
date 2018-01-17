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
        'transaction_id', 'user_id', 'file', 'comments', 'geo_type', 'status', 'country_id', 'shipping_company', 'credit_company', 'amount', 'discount', 'currency', 'total'
    ];

    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where(function ($query) use ($search) {
                $query->where('transaction_id', 'like', '%' . $search . '%');
                /*->orWhere('email', 'like', '%' . $search . '%')
                ->orWhereHas('profile' , function ($query) use ($search){
                    $query->where('applicant_name', 'like', '%' . $search . '%');
                  });*/
            });
        }

        return $query;
    }

    public function generateTransactionId()
    {
        $transactions = $this->where('quotation_id', $this->quotation_id)->count();

        $this->transaction_id = 'Purchase Order ' . $this->quotation_id;

        $purchase = $this->save();

        return $purchase;
    }

    public function isPending()
    {
        return $this->status == 0;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }
    public function commission()
    {
        return $this->hasOne(Commission::class);
    }

    /**
     * Determine if the user has the given role.
     *
     * @param  mixed $role
     * @return boolean
     */
    public function createdBy($user)
    {
        return $this->where('user_id', $user->id)->count();
    }
}
