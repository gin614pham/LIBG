<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdatePhanLoaiRequest extends FormRequest
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
            'GhiChu'=> 'string|nullable|max:255',
        ];
    }
    public function messages()
    {
        return [
            'GhiChu.string' => 'Ghi Chú phải là một chuỗi',
            'GhiChu.max' => 'Ghi Chú quá dài',
        ];
    }

}
