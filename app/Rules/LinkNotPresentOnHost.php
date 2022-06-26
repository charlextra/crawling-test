<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Traits\Rules\HostStatus;

class LinkNotPresentOnHost implements Rule
{
    use HostStatus;

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
        return $this->isLinkNotPresentOnHost($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The link is already present on the destination.';
    }
}
