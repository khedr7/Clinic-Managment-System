<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'register'   =>  $this->getRegisterRules(),
            'login'      =>  $this->getLoginRules(),
            'create'     =>  $this->getCreateRules(),
            'update'     =>  $this->getUpdateRules(),
        };
    }

    public function getRegisterRules()
    {
        return [
            'name'     => 'required|min:3|max:25',
            'email'    => 'required|email|unique:users,email',
            // 'password' => 'required|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x]).*$/',
            'password' => 'required|min:6',
            'address'  => 'nullable',
            'phone'    => 'required|min:9|max:10|unique:users,phone',
            'gender'   => 'required|in:male,female',
            'birthday' => 'nullable|date',
            'image'    => 'nullable|image|mimes:png,jpg,jpeg',
        ];
    }

    public function getLoginRules()
    {
        return [
            'email'    => 'required',
            'password' => 'required',
        ];
    }

    public function getCreateRules()
    {
        if (request()->role == 'doctor') {
            return [
                'name'               => 'required|min:3|max:25',
                'email'              => 'required|email|unique:users,email',
                // 'password'            => 'required|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x]).*$/',
                'password'           => 'required|min:6',
                'address'            => 'nullable',
                'phone'              => 'required|min:9|max:10|unique:users,phone',
                'gender'             => 'required|in:male,female',
                'role'               => 'required|in:admin,doctor,user',
                'birthday'           => 'nullable|date',
                'image'              => 'nullable|image|mimes:png,jpg,jpeg',
                'specialization_id'  => 'required|exists:specializations,id',
            ];
        } else {
            return [
                'name'               => 'required|min:3|max:25',
                'email'              => 'required|email|unique:users,email',
                // 'password'            => 'required|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x]).*$/',
                'password'           => 'required|min:6',
                'address'            => 'nullable',
                'phone'              => 'required|min:9|max:10|unique:users,phone',
                'gender'             => 'required|in:male,female',
                'role'               => 'required|in:admin,doctor,user',
                'birthday'           => 'nullable|date',
                'image'              => 'nullable|image|mimes:png,jpg,jpeg',
            ];
        }
    }

    public function getUpdateRules()
    {
        if (request()->role == 'doctor') {
            return [
                'name'               => 'required|min:3|max:25',
                'email'              => 'required|email|unique:users,email,' . $this->route()->id . ',id',
                'password'           => 'required|min:6',
                'address'            => 'nullable',
                'phone'              => 'required|min:9|max:10|unique:users,phone,' . $this->route()->id . ',id',
                'gender'             => 'required|in:male,female',
                'role'               => 'required|in:admin,doctor,user',
                'birthday'           => 'nullable|date',
                'image'              => 'nullable|image|mimes:png,jpg,jpeg',
                'specialization_id'  => 'required|exists:specializations,id',
            ];
        } else {
            return [
                'name'               => 'required|min:3|max:25',
                'email'              => 'required|email|unique:users,email,' . $this->route()->id . ',id',
                'password'           => 'required|min:6',
                'address'            => 'nullable',
                'phone'              => 'required|min:9|max:10|unique:users,phone,' . $this->route()->id . ',id',
                'gender'             => 'required|in:male,female',
                'role'               => 'required|in:admin,doctor,user',
                'birthday'           => 'nullable|date',
                'image'              => 'nullable|image|mimes:png,jpg,jpeg',
            ];
        }
    }
}
