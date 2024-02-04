<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpecializationRequest extends FormRequest
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

        return match ($this->route()->getActionMethod()) {
            'create'   =>  $this->getCreateRules(),
            'update'   =>  $this->getUpdateRules(),
        };
    }

    public function getCreateRules()
    {
        return [
            'title'   => 'array|required',
            'details' => 'array|required',

            'title.en'   => 'required',
            'title.ar'   => 'required',

            'details.en'   => 'required',
            'details.ar'   => 'required',

            'image'   => 'required|image|mimes:png,jpg,jpeg',

        ];
    }

    public function getUpdateRules()
    {
        return [
            'title'   => 'array|required',
            'details' => 'array|required',

            'title.en'   => 'required',
            'title.ar'   => 'required',

            'details.en'   => 'required',
            'details.ar'   => 'required',

            'image'   => 'nullable|image|mimes:png,jpg,jpeg',
        ];
    }
}
