<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GlobalSetting extends Model
{
    protected $fillable = [
        'discount', 'gross_commission'
    ];
    public $timestamps = false;
}
