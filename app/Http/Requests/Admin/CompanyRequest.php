<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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

    //rule
    public function rules()
    {
        return [
            'cp_name' => 'required|min:5',
            'cp_email' => 'required|email',
            'cp_phoneNumber' => 'required|min:9|integer',
            'cp_address' => 'required|min:5',
        ];
    }

    //message
    public function messages()
    {
        return [
            // cp_name
            'cp_name.required' => 'Name không được để trống',
            'cp_name.min' => 'Name phải từ :min ký tự trở lên',
            // cp_email
            'cp_email.required' => 'Email không được để trống',
            'cp_email.email' => 'Email không đúng định dạng',
            // cp_numberPhone
            'cp_phoneNumber.required' => 'Phone Number không được để trống',
            'cp_phoneNumber.integer' => 'Phone Number không đúng định dạng',
            // user_address
            'cp_address.required' => 'Address không được để trống',
            'cp_address.min' => 'Address phải từ :min ký tự trở lên',
        ];
    }
}
