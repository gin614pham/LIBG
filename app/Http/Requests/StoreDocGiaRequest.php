<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreDocGiaRequest extends FormRequest
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
            'Ten' => 'required|min:1|max:255',
            'GioiTinh' => 'required',
            'NgaySinh' => 'required|date|after:100 year ago|before_or_equal: 12 year ago',
            'SDT' => 'required|numeric|digits:10',
            'Email' => 'required|email',
        ];
    }

    public function messages(): array
    {
        return [
            'Ten.required' => 'Tên không được để trống',
            'Ten.min' => 'Tên quá ngắn',
            'Ten.max' => 'Tên quá dài',
            'GioiTinh.required' => 'Giới Tính không được để trống',
            'NgaySinh.required' => 'Ngày Sinh không được để trống',
            'NgaySinh.date' => 'Ngày Sinh phải có định dạng date',
            'NgaySinh.after' => 'Tuổi của Độc Giả phải nhỏ hơn 100',
            'NgaySinh.before_or_equal' => 'Tuổi của Độc Giả phải lớn hơn hoặc bằng 12',
            'SDT.required' => 'Số Điện Thoại không được để trống',
            'SDT.numeric' => 'Số Điện Thoại phải là chữ số',
            'SDT.digits' =>'Số Điện Thoại phải có 10 chữ số',
            'Email.required' => 'Email không được để trống',
            'Email.email' => 'Email phải là 1 email',
        ];
    }

}
