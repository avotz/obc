<?php

namespace App\Rules;

use App\User;
use Illuminate\Contracts\Validation\Rule;

class Partner implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return User::whereHas('roles', function($q){
                $q->where('name', 'partner');
            })->where('active', 1)
            ->where('private_code', $value)->first();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute not found like partner or is inactive';
    }
}
