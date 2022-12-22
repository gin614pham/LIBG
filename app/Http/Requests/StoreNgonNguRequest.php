<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreNgonNguRequest extends FormRequest
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
            'TenNN' => 'required|unique:ngon_ngus|max:255|min:1',
            'GhiChu'=> 'string|nullable|max:255',
        ];

    }
    public function messages()
    {
        return [
            'TenNN.required' => 'Tên Ngôn Ngữ không được để trống',
            'TenNN.unique' => 'Tên Ngôn Ngữ không được trùng',
            'TenNN.min' => 'Tên Ngôn Ngữ quá ngắn',
            'TenNN.max' => 'Tên Ngôn Ngữ quá dài',
            'GhiChu.string' => 'Ghi Chú phải là một chuỗi',
            'GhiChu.max' => 'Ghi Chú quá dài',
        ];
    }
}
