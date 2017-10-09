<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CreditDays extends Model
{
    protected $fillable = [
        'days',
    ];
    public $timestamps = false;

}
