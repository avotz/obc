<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    protected $fillable = [
        'interest_30', 'interest_45', 'interest_60'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
   
}
