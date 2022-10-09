<?php

namespace App\Http\Requests\Admin;

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

    //rule
    public function rules()
    {
        return [
            'user_name' => 'required|min:5',
            'user_email' => 'required|email',
            'user_phoneNumber' => 'required|integer',
            'user_password' => 'required|min:6',
            'user_address' => 'required|min:5',
            'ur_id'=> ['required', 'integer', function($atrribute, $value, $fail){
                if($value==0){
                    $fail('Bắt buộc phải chọn Role');
                }
            }]
        ];
    }

    //message
    public function messages()
    {
        return [
            // user_name
            'user_name.required' => 'Name không được để trống',
            'user_name.min' => 'Name phải từ :min ký tự trở lên',
            // user_email
            'user_email.required' => 'Email không được để trống',
            'user_email.email' => 'Email không đúng định dạng',
            'user_email.unique' => 'Email đã tồn tại trên hệ thống',
            // user_numberPhone
            'user_phoneNumber.required' => 'Phone Number không được để trống',
            'user_phoneNumber.integer' => 'Phone Number không đúng định dạng',
            // user_password
            'user_password.required' => 'Password không được để trống',
            'user_password.min' => 'Password phải từ :min ký tự trở lên',
            // user_address
            'user_address.required' => 'Address không được để trống',
            'user_address.min' => 'Address phải từ :min ký tự trở lên',
            // user_role
            'ur_id.required' => 'Role không được để trống',
        ];
    }
}
