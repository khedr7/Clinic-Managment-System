<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorScheduleRequest extends FormRequest
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
            'day' => '',
            'start_time' => '',
            'end_time' => '',
            'medical_session_time' => '',
            'doctor_id' => '',
        ];
    }

    public function getUpdateRules()
    {
        return [
            'day' => '',
            'start_time' => '',
            'end_time' => '',
            'medical_session_time' => '',
            'doctor_id' => '',
        ];
    }
}
