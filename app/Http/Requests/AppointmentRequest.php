<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
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
            'updateStatus'   =>  $this->getUpdateStatusRules(),
        };
    }

    public function getCreateRules()
    {
        return [
            'date'      => 'required|date|after:' . now(),
            'doctor_id' => 'required|exists:users,id',
            'note'      => 'nullable|max:255',
        ];
    }

    public function getUpdateStatusRules()
    {
        return [
            'status' => 'required|in:Confirmed,Pending,Cancelled',
        ];
    }
}
