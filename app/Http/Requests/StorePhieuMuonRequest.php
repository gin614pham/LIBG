<?php

namespace App\Http\Requests;

use App\Http\Services\PhieuMuonServices;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StorePhieuMuonRequest extends FormRequest
{
    private PhieuMuonServices $phieuMuonServices;
    public function __construct(PhieuMuonServices $phieuMuonServices)
    {
        $this->phieuMuonServices = $phieuMuonServices;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    public function withValidator($validator)
    {
        $MaDG = $this->MaDG;
        if (!empty($MaDG))
        $validator->after(function ($validator) {
            if (!$this->phieuMuonServices->checkSoLuong($this->MaDG)) {
                $validator->errors()->add('MaDG', 'Mỗi độc giả chỉ được mượn tối đa 3 cuốn sách');
            }
        });
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'MaDG' => 'required',
            'MaSach' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'MaDG.required' => 'Độc Giả không được để trống',
            'MaSach.required' => 'Sách không được để trống',
        ];
    }




}
