<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Sector extends Model
{
    use NodeTrait;
    protected $fillable = [
        'name', 'description'
    ];
    
    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }

}
