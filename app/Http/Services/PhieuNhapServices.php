<?php

namespace App\Http\Services;

use App\Models\PhieuNhap;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class PhieuNhapServices {
    private PhieuNhap $phieuNhap;

    public function __construct(PhieuNhap $phieuNhap) {
        $this->phieuNhap = $phieuNhap;
    }

    public function getAll(){
        return $this->phieuNhap->all();
    }

    public function findAll()
    {
        return $this->phieuNhap->orderBy('MaPhieuNhap', 'desc')->paginate(10);
    }

    public function findOne($id)
    {
        return $this->phieuNhap->find($id);
    }

    public function create($request): bool
    {
        $newPN = new PhieuNhap([
            'MaDauSach' => $request->MaDauSach,
            'MaNCC' => $request->MaNCC,
            'NguoiNhap' => Auth::user()->Ten,
            'SoLuong' => $request->SoLuong,
        ]);
        return $newPN->save();
    }

    public function update($id, $request): bool
    {
        return $this->phieuNhap->update($id, [
            'MaDauSach' => $request->MaDauSach,
            'MaNCC' => $request->MaNCC,
            'NguoiNhap' => $request->NguoiNhap,
            'SoLuong' => $request->SoLuong,
            ]);
    }

    public function delete($id): JsonResponse
    {
        try {
            $item = $this->findOne($id);
            if ($item){
                $item->delete();
                return response()->json([
                    'check' => true,
                    'message' => 'ok'
                ], 200);
            } else {
                return response()->json([
                    'check' => false,
                    'message' => '!ok'
                ], 400);
            }
        } catch (\Exception $e){
            echo $e->getMessage();
            return response()->json([
                'check' => false,
                'message' => '!ok'
            ], 400);

        }
    }
}
