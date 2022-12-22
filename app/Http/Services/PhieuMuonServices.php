<?php

namespace App\Http\Services;

use App\Models\DocGia;
use App\Models\PhieuMuon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class PhieuMuonServices {
    private PhieuMuon $phieuMuon;
    private DocGia $docGia;

    public function __construct(PhieuMuon $phieuMuon, DocGia $docGia) {
        $this->phieuMuon = $phieuMuon;
        $this->docGia = $docGia;
    }

    public function getAll() {
        return $this->phieuMuon->all();
    }

    public function findAll()
    {
        return $this->phieuMuon->orderBy('NgayTra')->orderBy('HanTra')->paginate(10);
    }

    public function findOne($id){
        return $this->phieuMuon->find($id);
    }

    public function create($request): bool
    {
            $newPM = new PhieuMuon([
                'MaDG' => $request->MaDG,
                'MaSach' => $request->MaSach,
                'NguoiChoMuon' => Auth::user()->Ten,
                'HanTra' => $request->HanTra,
            ]);
        return $newPM->save();
    }

    public function update($request, $id){
        $updatedPM = $this->findOne($id);
        $updatedPM->MaDG = $request->MaDG ?? $updatedPM->MaDG ;
        $updatedPM->MaSach = $request->MaSach ?? $updatedPM->MaSach;
        $updatedPM->NguoiChoMuon = $request->NguoiChoMuon ?? $updatedPM->NguoiChoMuon;
        $request->NgayTra == 'NULL' ? $updatedPM->NguoiNhan = null : $updatedPM->NguoiNhan = Auth::user()->Ten;
        $request->NgayTra == 'NULL' ? $updatedPM->NgayTra = null : $updatedPM->NgayTra = $request->NgayTra;
        return $updatedPM->update();
    }

    public function delete($id){
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
        } catch (\Exception $e) {
            echo $e->getMessage();
            return response()->json([
                'check' => false,
                'message' => '!ok'
            ], 400);
        }
    }

    public function trasach($id): JsonResponse
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $item = $this->findOne($id);
        $item->NgayTra = date("Y/m/d");
        $item->NguoiNhan = Auth::user()->Ten;
        if ($item->update()) {
            return response()->json([
                'check' => true,
                'message' => 'ok',
                'NgayTra' => $item->NgayTra,
            ], 200);
        } else {
            return response()->json([
                'check' => false,
                'message' => '!ok',
                'NgayTra' => null,
            ], 400);
        }
    }

    public function checkSoLuong($id): bool
    {
        $item = $this->docGia->find($id)->PhieuMuon;
        if ($item) {
            return $item->where('NgayTra', null)->count() < 3;
        }
        return false;
    }

}
