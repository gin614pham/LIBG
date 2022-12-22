<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreTheLoaiRequest extends FormRequest
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
            'TenTL' => 'required|unique:the_loais|max:255|min:1',
            'GhiChu'=> 'string|nullable|max:255',
        ];
    }

    public function messages()
    {
        return [
            'TenTL.required' => 'Tên Thể Loại không được để trống',
            'TenTL.unique' => 'Tên Thể Loại không được trùng',
            'TenTL.min' => 'Tên Thể Loại quá ngắn',
            'TenTL.max' => 'Tên Thể Loại quá dài',
            'GhiChu.string' => 'Ghi Chú phải là một chuỗi',
            'GhiChu.max' => 'Ghi Chú quá dài',
        ];
    }

}
