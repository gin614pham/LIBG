<?php

namespace App\Http\Services;

use App\Models\PhanLoai;
use Illuminate\Database\Eloquent\Collection;

class PhanLoaiServices {
    private PhanLoai $phanLoai;

    public function __construct(PhanLoai $phanLoai) {
        $this->phanLoai = $phanLoai;
    }

    public function findAll(): Collection
    {
        return $this->phanLoai->all();
    }

    public function findOne($id) {
        return $this->phanLoai->find($id);
    }

    public function create($request): bool
    {
        $newPhanLoai = new PhanLoai([
            'TenPL' => $request->TenPL,
            'GhiChu' => $request->GhiChu,
        ]);

        return $newPhanLoai->save();
    }

    public function update($id, $request) {
        $updatedPhanLoai = $this->findOne($id);
        $updatedPhanLoai->TenPL = $request->TenPL ?? $updatedPhanLoai->TenPL;
        $updatedPhanLoai->GhiChu = $request->GhiChu;
        return $updatedPhanLoai->update();
    }

    public function delete($id) {
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
