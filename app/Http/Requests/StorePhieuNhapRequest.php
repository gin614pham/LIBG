<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StorePhieuNhapRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
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
            'MaDauSach' => 'required',
            'MaNCC' => 'required',
            'SoLuong' => 'required|numeric|between:1,50',
        ];
    }

    public function messages(): array
    {
        return [
            'MaDauSach.required' => 'Sách không được để trống',
            'MaNCC.required' => 'Nhà Cung Cấp không được để trống',
            'SoLuong.between' => 'Số Lượng không hợp lệ (0 < số lượng <= 50)',
            'SoLuong.required' => 'Số Lượng không được để trống',
            'SoLuong.numeric' => 'Số Lượng Phải là một số',
        ];
    }

}
