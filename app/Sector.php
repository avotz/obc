<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    protected $fillable = [
        'name', 'description', 'parent_id'
    ];
    
    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class, 'parent_id');
    }

    public function subsectors()
    {
        return $this->hasMany(Sector::class, 'parent_id');
    }
}
