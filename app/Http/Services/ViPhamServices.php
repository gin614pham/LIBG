<?php

namespace App\Http\Services;

use App\Models\ViPham;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ViPhamServices {
    private ViPham $viPham;

    public function __construct(ViPham $viPham) {
        $this->viPham = $viPham;
    }

    public function findAll(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->viPham->all();
    }

    public function findOne($id) {
        return $this->viPham->find($id);
    }

    public function create($request): bool
    {
        $newVP = new ViPham([
            'MaDG' => $request->MaDG,
            'LyDoVP' => $request->LyDoVP,
            'HinhThucXL' => $request->HinhThucXL,
            'NguoiXL' => Auth::user()->Ten,
        ]);

        return $newVP->save();
    }

    public function update($id, $request): bool
    {
        $vp = $this->findOne($id);

        $vp->MaSV = $request->MaSV;
        $vp->LyDoVP = $request->LyDoVP;
        $vp->HinhThucXL = $request->HinhThucXL;
        $vp->NguoiXL = $request->NguoiXL;
        return $vp->update();
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

    public function search($id): bool{
        return $this->findOne($id)->DocGia()->where('Ten', 'like','%Phạm% ')->get();

    }

}
