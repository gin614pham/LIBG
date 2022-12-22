<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateDauSachRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'TenSach' => 'required|min:1|max:255',
            'TacGia' => 'required|min:1|max:255',
            'MaTL' => 'required',
            'MaPL' => 'required',
            'MaNN' => 'required',
            'NhaXuatBan' => 'required|min:1|max:255',
            'NamXuatBan' => 'required|date_format:Y|after:1900|before_or_equal:this year|',
            'GhiChu' => 'string|nullable|max:255',
            'Gia' => 'required|alpha_num|min:1|max:100000000000'
        ];
    }

    public function messages(): array
    {
        return [
            'TenSach.required' => 'Tên Sách không được để trống',
            'TenSach.min' => 'Tên Sách quá ngắn',
            'TenSach.max' => 'Tên Sách quá dài',
            'TacGia.required' => 'Tác Giả không được để trống',
            'TacGia.min' => 'Tên Tác Giả quá ngắn',
            'TacGia.max' => 'Tên Tác Giả quá dài',
            'MaTL.required' => 'Thể Loại không được để trống',
            'MaPL.required' => 'Phân Loại không được để trống',
            'MaNN.required' => 'Ngôn Ngữ không được để trống',
            'NhaXuatBan.required' => 'Nhà Xuất Bản không được để trống',
            'NhaXuatBan.min' => 'Tên Nhà Xuất Bản quá ngắn',
            'NhaXuatBan.max' => 'Tên Nhà Xuất Bản quá dài',
            'NamXuatBan.required' => 'Năm Xuất Bản không được để trống',
            'NamXuatBan.date_format' => 'Năm Xuất Bản phải là năm',
            'NamXuatBan.after' => 'Năm Xuất Bản quá nhỏ',
            'NamXuatBan.before_or_equal' => 'Năm Xuất Bản quá lớn',
            'GhiChu.string' => 'Ghi Chú phải là một chuỗi',
            'GhiChu.max' => 'Ghi Chú quá dài',
            'Gia.required' => 'Giá không được để trống',
            'Gia.alpha_num' => 'Giá Phải là một số',
            'Gia.min' => 'Giá quá nhỏ',
            'Gia.max' => 'Giá quá lớn',
        ];
    }

}
