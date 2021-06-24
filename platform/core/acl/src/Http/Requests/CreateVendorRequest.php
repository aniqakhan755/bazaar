<?php

namespace Botble\ACL\Http\Requests;

use Botble\Support\Http\Requests\Request;

class CreateVendorRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name'            => 'required|max:60|min:2',
            'last_name'             => 'required|max:60|min:2',
            'email'                 => 'required|max:60|min:6|email|unique:users',
            'password'              =>  ['required', 'string', 'min:8', 'confirmed', 'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/'],
            'password_confirmation' => 'required|same:password',
            'username'              => 'required|min:4|max:30|unique:users',
            'cnic'                  => 'required|max:15|unique:users',
            'phone'                  => 'required|max:11|unique:users',
        ];
    }
}