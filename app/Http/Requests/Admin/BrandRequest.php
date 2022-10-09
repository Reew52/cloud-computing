<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
        return [
            'brand_name' => 'required|unique:brands'
        ];
    }

    //message
    public function messages()
    {
        return [
            // cp_name
            'brand_name.required' => 'Name không được để trống',
            'brand_name.unique' => 'Hệ thống đã tồn tại thương hiệu này',
        ];
    }

}
