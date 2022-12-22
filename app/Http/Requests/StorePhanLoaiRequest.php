<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StorePhanLoaiRequest extends FormRequest
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
            'TenPL' => 'required|unique:phan_loais|max:255|min:1',
            'GhiChu'=> 'string|nullable|max:255',
        ];
    }

    public function messages()
    {
        return [
            'TenPL.required' => 'Tên Phân Loại không được để trống',
            'TenPL.unique' => 'Tên Phân Loại không được trùng',
            'TenPL.min' => 'Tên Phân Loại quá ngắn',
            'TenPL.max' => 'Tên Phân Loại quá dài',
            'GhiChu.string' => 'Ghi Chú phải là một chuỗi',
            'GhiChu.max' => 'Ghi Chú quá dài',
        ];
    }

}
