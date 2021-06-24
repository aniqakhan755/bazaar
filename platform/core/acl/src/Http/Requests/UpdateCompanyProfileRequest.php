<?php

namespace Botble\ACL\Http\Requests;

use Botble\Support\Http\Requests\Request;

class UpdateCompanyProfileRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'company_name' => 'required',
            'about_company' => 'required',
            'company_address' => 'required',
            'country' => 'required',
            'city' => 'required',
        ];
    }
}
