<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Sector extends Model
{
    use NodeTrait;
    protected $fillable = [
        'name', 'name_es', 'description', 'parent_id'
    ];

    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('name_es', 'like', '%' . $search . '%');
            });
        }

        return $query;
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }
}
