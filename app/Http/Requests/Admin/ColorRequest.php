<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ColorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'color_name' => 'required|unique:colors'
        ];
    }

    //message
    public function messages()
    {
        return [
            // cp_name
            'color_name.required' => 'Name không được để trống',
            'color_name.unique' => 'Hệ thống đã tồn tại màu sắc này',
        ];
    }
}
