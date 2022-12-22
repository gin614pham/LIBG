<?php

namespace App\Http\Services;

use App\Models\DauSach;
use Illuminate\Database\Eloquent\Collection;

class DauSachServices {
    private DauSach $dauSach;

    public function __construct(DauSach $dauSach){
        $this->dauSach = $dauSach;

    }

    public function findAll(): Collection
    {
        return $this->dauSach->all();
    }

    public function findOne($id){
        return $this->dauSach->find($id);
    }

    public function getAllPaginate()
    {
        return $this->dauSach->paginate(10);
    }

    public function create($request): bool
    {
        $newDauSach = new DauSach([
            'MaDauSach' => $request->MaDauSach,
            'TenSach' => $request->TenSach,
            'TacGia' => $request->TacGia,
            'MaTL' => $request->MaTL,
            'MaPL' => $request->MaPL,
            'MaNN' => $request->MaNN,
            'NhaXuatBan' => $request->NhaXuatBan,
            'NamXuatBan' => $request->NamXuatBan,
            'Gia' => $request->Gia,
            'GhiChu' => $request->GhiChu,

        ]);

        return $newDauSach->save();
    }

    public function update($request, $id): bool
    {
        $dauSach = $this->findOne($id);
        if ($dauSach)
        return $dauSach->update([
            'TenSach' => $request->TenSach ?? $dauSach->TenSach,
            'TacGia' => $request->TacGia ?? $dauSach->TacGia,
            'MaTL' => $request->MaTL ?? $dauSach->MaTL,
            'MaPL' => $request->MaPL ?? $dauSach->MaPL,
            'NhaXuatBan' => $request->NhaXuatBan ?? $dauSach->NhaXuatBan,
            'NamXuatBan' => $request->NamXuatBan ?? $dauSach->NamXuatBan,
            'MaNN' => $request->MaNN ?? $dauSach->MaNN,
            'Gia' => $request->Gia ?? $dauSach->Gia,
            'GhiChu' => $request->GhiChu ?? $dauSach->GhiChu,
        ]);
        return false;
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
        } catch (\Exception $e){
            echo $e->getMessage();
            return response()->json([
                'check' => false,
                'message' => '!ok'
            ], 400);

        }
    }

}
