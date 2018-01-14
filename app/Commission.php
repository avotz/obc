<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Commission extends Model
{
    protected $fillable = [
        'company_id', 'purchase_order_id', 'status', 'country_id', 'currency', 'amount','percent','total'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
    public function purchase()
    {
        return $this->belongsTo(PurchaseOrder::class, 'purchase_order_id');
    }

}
