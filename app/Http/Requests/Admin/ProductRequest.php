<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            //
            'pro_name' => 'required|min:5',
            'brand_id'=> ['required', 'integer', function($atrribute, $value, $fail){
                if($value==0){
                    $fail('Bắt buộc phải chọn Brand');
                }
            }],
            'color_id'=> ['required', 'integer', function($atrribute, $value, $fail){
                if($value==0){
                    $fail('Bắt buộc phải chọn Color');
                }
            }],
            'pro_ram'=> ['required', 'integer', function($atrribute, $value, $fail){
                if($value==0){
                    $fail('Bắt buộc phải chọn Ram');
                }
            }],
            'pro_iMemory'=> ['required', 'integer', function($atrribute, $value, $fail){
                if($value==0){
                    $fail('Bắt buộc phải chọn Bo nho trong');
                }
            }],
            'pro_oSystem'=> ['required', function($atrribute, $value, $fail){
                if($value=="0"){
                    $fail('Bắt buộc phải chọn He dieu hanh');
                }
            }],
            'pro_warrantyPeriod'=> ['required', function($atrribute, $value, $fail){
                if($value== '0'){
                    $fail('Bắt buộc phải chọn thoi gian bao hanh');
                }
            }],
            'pro_image' => 'required|file',
            // 'pro_image1' => 'required|file',
            // 'pro_image2' => 'required|file',
            // 'pro_image3' => 'required|file',
            // 'pro_image4' => 'required|file',
            'pro_quatity' => 'required|integer',
            'pro_origin' => 'required|min:5',
            'pro_price' => 'required|integer',
            'pro_reducedPrice' => 'required|integer',
            'pro_launchDate' => 'required|date',
            'pro_description' => 'required|min:20',
        ];
    }

    //message
    public function messages()
    {
        return [
            // pro_name
            'pro_name.required' => 'Tên sản phẩm không được để trống',
            'pro_name.min' => 'Tên sản phẩm phải từ :min ký tự trở lên',
            // brand_id
            'brand_id.required' => 'Thương hiệu không được để trống',
            'brand_id.integer' => 'Thương hiệu không đúng định dạng',
            // color_id
            'color_id.required' => 'Màu sắc không được để trống',
            'color_id.integer' => 'Màu sắc không đúng định dạng',
            // pro_ram
            'pro_ram.required' => 'RAM không được để trống',
            'pro_ram.integer' => 'RAM không đúng định dạng',
            // pro_iMemory
            'pro_iMemory.required' => 'Bộ nhớ trong không được để trống',
            'pro_iMemory.integer' => 'Bộ nhớ trong không đúng định dạng',
            // pro_warrantyPeriod
            'pro_warrantyPeriod.required' => 'Thời gian bảo hành không được để trống',
            'pro_warrantyPeriod.integer' => 'Thời gian bảo hành không đúng định dạng',
            // pro_oSystem
            'pro_oSystem.required' => 'Hệ điều hành không được để trống',
            // pro_image
            'pro_image.required' => 'Image Main không được để trống',
            'pro_image.file' => 'Image Main phải là file',
            // pro_image1
            'pro_image1.required' => 'Image 01 không được để trống',
            'pro_image1.file' => 'Image 01 Main phải là file',
            // pro_image2
            'pro_image2.required' => 'Image 02 không được để trống',
            'pro_image2.file' => 'Image 02 Main phải là file',
            // pro_image3
            'pro_image3.required' => 'Image 03 không được để trống',
            'pro_image3.file' => 'Image 03 phải là file',
            // pro_image4
            'pro_image4.required' => 'Image 04 không được để trống',
            'pro_image4.file' => 'Image 04 phải là file',
            // pro_quatity
            'pro_quatity.required' => 'Số lượng không được để trống',
            'pro_quatity.integer' => 'Số lượng không đúng định dạng',
            // pro_origin
            'pro_origin.required' => 'Xuất xứ không được để trống',
            'pro_origin.min' => 'Xuất xứ phải từ :min ký tự trở lên',
            // pro_price
            'pro_price.required' => 'Giá không được để trống',
            'pro_price.integer' => 'Giá không đúng định dạng',
            // pro_reducedPrice
            'pro_reducedPrice.required' => 'Giá giảm không được để trống',
            'pro_reducedPrice.integer' => 'Giá giảm không đúng định dạng',
            // pro_launchDate
            'pro_launchDate.required' => 'Ngày ra mắt không được để trống',
            'pro_launchDate.date' => 'Ngày ra mắt không hợp lệ',
            // pro_description
            'pro_description.required' => 'Mô tả không được để trống',
            'pro_description.min' => 'Mô tả phải từ :min ký tự trở lên',
        ];
    }
}
