<?php

namespace App\Http\Services;

use App\Models\PhanLoai;
use App\Models\Sach;
use App\Models\ThanhLy;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class SachServices{
    private Sach $sach;
    private PhanLoai $phanLoai;
    private ThanhLy $thanhLy;
    public function __construct(
        Sach $sach,
        PhanLoai $phanLoai,
        ThanhLy $thanhLy
    )
    {
        $this->sach = $sach;
        $this->phanLoai = $phanLoai;
        $this->thanhLy = $thanhLy;
    }

    public function getAll()
    {
        return $this->sach->all();
    }

    public function findAll(): Collection
    {
        return $this->sach->all()->reject(function($value){
            return $value->ThanhLy;
        });
    }

    public function getAllPaginate(){
        return $this->sach->orderBy('MaSach', 'desc')->paginate(10);
    }

    public function findOne($id){
        return $this->sach->find($id);
    }

    public function sachMuon(){
        return $this->phanLoai->find(2)->Sach()->where('TinhTrang', 'Sẵn sàng')->get()->reject(function($value){
            return $value->ThanhLy;
        });
    }

    public function sachTL($id){
        $item = $this->findOne($id);
        return $item->update([
           'ThanhLy' => true,
        ]);
    }

    public function create($request): bool
    {
        $newSach = new Sach([
            'MaDauSach' => $request->MaDauSach,
            'TinhTrang' => $request->TinhTrang,
            'NguoiCN' => Auth::user()->Ten,

        ]);

        return $newSach->save();
    }

    public function createMultiple($request): void
    {
        for ($i = 0; $i < $request->SoLuong; $i++){
            $this->create($request);
        }
    }

    public function update($request, $id): bool
    {
        $sach = $this->findOne($id);
        if ($sach)
            return $sach->update([
                'MaDauSach' => $request->MaDauSach ?? $sach->MaDauSach,
                'TinhTrang' => $request->TinhTrang ?? $sach->TinhTrang,
                'NguoiCN' => auth()->user()->Ten,
            ]);
        return false;
    }

    public function delete($id)
    {
        try {
            $item = $this->findOne($id);
            if ($item) {
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

    public function muonSach($id): bool
    {
        $sach = $this->findOne($id);
        if ($sach){
            return $sach->update([
                'TinhTrang' => "Bận",
            ]);
        }
        return false;
    }

    public function traSach($id): bool
    {
        $sach = $this->findOne($id);
        if ($sach){
            return $sach->update([
                'TinhTrang' => "Sẵn sàng",
            ]);
        }
        return false;
    }

    public function restore($id)
    {
        $item = $this->findOne($id);
        return $item->update([
            'ThanhLy' => false,
        ]);
    }

}
