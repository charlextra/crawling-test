<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\AvalaibleHost;
use App\Rules\LinkNotPresentOnHost;

class StoreCustomLinkRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return  [
                    'url_destination.*' => [
                        'required',
                        'regex:(https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|www\.[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9]+\.[^\s]{2,}|www\.[a-zA-Z0-9]+\.[^\s]{2,})',
                        new AvalaibleHost,
                    ],

                    'url_ajout.*' => [
                        'required',
                        'regex:(https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|www\.[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9]+\.[^\s]{2,}|www\.[a-zA-Z0-9]+\.[^\s]{2,})',
                        new AvalaibleHost,
                        new LinkNotPresentOnHost((array)$this->request->get('ancre'), (array)$this->request->get('url_destination')),
                    ],

                    'ancre.*' => ['required'],
                ];
    }

    /**
     * Get the validation messages that apply to the rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'url_destination.*.required' => 'The destination url is required',
            'url_destination.*.unique' => 'This url is already used',
            'url_destination.*.regex' => 'The destination url have to be a valid url',
            'url_ajout.*.required' => 'The url to be added is required',
            'url_ajout.*.regex' => 'The destination url have to be a valid url',
            'ancre.*.required' => 'The anchor is required',
        ];
    }
}
