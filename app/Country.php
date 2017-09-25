<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'name', 'code', 'currency'
    ];

    public function scopeSearch($query, $search)
    {
        if($search){

            return $query->where(function ($query) use ($search)
            {
                $query->where('code', 'like', '%'. $search .'%')
                    ->orWhere('name', 'like', '%' . $search . '%');
                
            });
        }

        return $query;
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
