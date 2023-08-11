<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class TokenValidationRule implements Rule
{
    public function passes($attribute, $value)
    {

        return $value === 'zmVQQaUsXscZTrRwFXluaIQX7erPkplRbmkwzdbA';
    }

    public function message()
    {
        return 'Invalid token.';
    }
}
