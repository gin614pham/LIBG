<?php

namespace App\Http\Services;

use App\Models\NgonNgu;

class NgonNguServices {
    private NgonNgu $ngonNgu;

    public function __construct(NgonNgu $ngonNgu) {
        $this->ngonNgu = $ngonNgu;
    }

    public function  findAll(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->ngonNgu->all();
    }

    public function findOne($id){
        return $this->ngonNgu->find($id);
    }

    public function create($request): bool
    {
        $newNN = new NgonNgu([
            'TenNN' =>  $request->TenNN,
            'GhiChu' => $request->GhiChu,
        ]);
        return $newNN->save();
    }

    public function update($request, $id){
        $updateNN = $this->ngonNgu->find($id);
        $updateNN->TenNN = $request->TenNN;
        $updateNN->GhiChu = $request->GhiChu;
        return $updateNN->update();
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
