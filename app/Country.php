<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'name', 'code', 'currency'
    ];

    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }
}
