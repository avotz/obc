<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'transaction_id', 'user_id', 'delivery_time', 'way_of_delivery', 'way_to_pay', 'comments', 'geo_type', 'product_name', 'product_photo', 'status', 'country_id', 'amount', 'discount', 'currency', 'total', 'company_id'
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
        $transactions = $this->where('request_id', $this->request_id)->count();

        $this->transaction_id = 'Quotation ' . $this->request_id . '-' . $transactions++;

        $quotation = $this->save();

        return $quotation;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function request()
    {
        return $this->belongsTo(QuotationRequest::class);
    }

    public function purchase()
    {
        return $this->hasOne(PurchaseOrder::class);
    }

    public function shippings()
    {
        return $this->hasMany(Shipping::class);
    }

    public function shippingsRequests()
    {
        return $this->hasMany(ShippingRequest::class);
    }

    public function credits()
    {
        return $this->hasMany(Credit::class);
    }

    public function creditRequests()
    {
        return $this->hasMany(CreditRequest::class);
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
