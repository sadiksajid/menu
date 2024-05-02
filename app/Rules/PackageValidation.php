<?php

namespace App\Rules;

use Illuminate\Support\Facades\Cache;
use Illuminate\Contracts\Validation\Rule;

class PackageValidation implements Rule
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
        $v_phone = substr($value, 0, 2);
        $ns = array("05", "06", "07", "08");
        if (in_array($v_phone, $ns)) {
            return  true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return Cache::get('customValidation')['insert_Valide_Number'];
    }
}
