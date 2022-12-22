<?php

namespace App\Http\Services;

use App\Models\TheLoai;

class TheLoaiServices {
    private TheLoai $theLoai;

    public function __construct(TheLoai $theLoai)   {
        $this->theLoai = $theLoai;
    }

    public function findAll(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->theLoai->all();
    }

    public function getAllPaginate()
    {
        return $this->theLoai->paginate(10);
    }

    public function findOne($id)
    {
        return $this->theLoai->find($id);
    }

    public function create($request)
    {
        $newTheLoai = new TheLoai([
            'TenTL' => $request->TenTL,
            'GhiChu' => $request->GhiChu,
        ]);

        return $newTheLoai->save();
    }

    public function update($request, $id){
        $updateTl = $this->findOne($id);
        $updateTl->TenTL = $request->TenTL ?? $updateTl->TenTL;
        $updateTl->GhiChu = $request->GhiChu;
        return $updateTl->update();
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
