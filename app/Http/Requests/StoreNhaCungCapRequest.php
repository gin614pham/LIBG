<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreNhaCungCapRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'TenNCC' => 'required|min:1|max:255',
            'DiaChi' => 'required|string|max:255',
            'SDT' => 'required|numeric|digits:10',
            'Email' => 'required|email',
        ];
    }

    public function messages(): array
    {
        return [
            'TenNCC.required' => 'Tên Nhà Cung Cấp không được để trống',
            'TenNCC.min' => 'Tên Nhà Cung Cấp quá ngắn',
            'TenNCC.max' => 'Tên Nhà Cung Cấp quá dài',
            'DiaChi.required' => 'Địa Chỉ không được để trống',
            'DiaChi.string' => 'Địa Chỉ phải là một chuỗi',
            'DiaChi.max' => 'Địa Chỉ quá dài',
            'SDT.required' => 'Số Điện Thoại không được để trống',
            'SDT.numeric' => 'Số Điện Thoại phải là chữ số',
            'SDT.digits' =>'Số Điện Thoại phải có 10 chữ số',
            'Email.required' => 'Email không được để trống',
            'Email.email' => 'Email phải là 1 email',
        ];
    }

}
