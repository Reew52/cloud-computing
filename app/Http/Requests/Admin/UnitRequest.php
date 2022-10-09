<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UnitRequest extends FormRequest
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
            'unit_name' => 'required|min:5',
            'unit_email' => 'required|email',
            'unit_phoneNumber' => 'required|integer',
            'unit_address' => 'required|min:5',
            'cp_id'=> ['required', 'integer', function($atrribute, $value, $fail){
                if($value==0){
                    $fail('Bắt buộc phải chọn Công ty');
                }
            }]
        ];
    }

    //message
    public function messages()
    {
        return [
            // unit_name
            'unit_name.required' => 'Name không được để trống',
            'unit_name.min' => 'Name phải từ :min ký tự trở lên',
            // unit_email
            'unit_email.required' => 'Email không được để trống',
            'unit_email.email' => 'Email không đúng định dạng',
            // unit_phoneNumber
            'unit_phoneNumber.required' => 'Phone Number không được để trống',
            'unit_phoneNumber.integer' => 'Phone Number không đúng định dạng',
            'unit_phoneNumber.min' => 'Phone Number phải từ :min ký tự trở lên',
            // unit_address
            'unit_address.required' => 'Address không được để trống',
            'unit_address.min' => 'Address phải từ :min ký tự trở lên',
            // cp_id
            'cp_id.required' => 'Công ty không được để trống',
        ];
    }
}
