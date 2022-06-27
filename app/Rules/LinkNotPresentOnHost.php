<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Traits\Rules\HostStatus;

class LinkNotPresentOnHost implements Rule
{
    use HostStatus;

    private $http_exception;
    private $second_attribute;
    private $third_attribute;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(array $second_attribute, array $third_attribute)
    {
        $this->second_attribute = $second_attribute;
        $this->third_attribute = $third_attribute;
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
        $splitAttributeName = explode('.',$attribute);
        $i = end($splitAttributeName);
        $response = $this->isLinkNotPresentOnHost($value, $this->second_attribute[$i], $this->third_attribute[$i]);
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
