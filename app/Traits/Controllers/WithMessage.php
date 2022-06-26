<?php

namespace App\Traits\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

/**
 * Trait WithMessage
 * @package App\Traits\Controllers
 */
trait WithMessage
{
    /**
     * Return to the previous page with success message.
     *
     * @param string $actionType
     * @param string|null $name
     *
     * @return RedirectResponse|JsonResponse
     */
    public function backWithSuccess(string $actionType, string $name = null)
    {
        $name = $name ?? $this->getNameAttributeFofMessage();
        $message = __('messages.Entity'.ucfirst($actionType), ['name' => $name]);

        return request()->expectsJson()
            ? response()->json(['message' => $message])
            : back()->with('success', $message);
    }

    /**
     * Return to the previous page with error message.
     *
     * @param string $message
     *
     * @return JsonResponse|RedirectResponse
     */
    public function backWithError(string $message)
    {
        return request()->expectsJson()
            ? response()->json(['message' => $message])
            : back()->with('error', $message);
    }

    /**
     * Extract name attribute from the controller class name.
     *
     * @return string
     */
    protected function getNameAttributeFofMessage(): string
    {
        return implode(
            ' ', preg_split('/(?=[A-Z])/', Str::before(class_basename($this), 'Controller'))
        );
    }
}
