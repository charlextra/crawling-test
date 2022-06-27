<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Traits\Rules\HostStatus;

class LinkNotPresentOnHost implements Rule
{
    use HostStatus;

    private $http_exception;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {

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
        $response = $this->isLinkNotPresentOnHost($value);
        if(is_bool($response)){
            return $response;
        }
        $this->http_exception = $response;
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->http_exception ? : 'Le lien est déjà présent dans la destination.';
    }
}
