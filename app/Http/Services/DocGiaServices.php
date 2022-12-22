<?php

namespace App\Http\Services;

use App\Models\DocGia;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class DocGiaServices{
    private DocGia $docGia;

    public function __construct(DocGia $docGia)
    {
        $this->docGia = $docGia;
    }

    public function findAll(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->docGia->all();
    }

    public function getAllPaginate()
    {
        return $this->docGia->paginate(10);
    }

    public function findOne($id)
    {
        return $this->docGia->find($id);
    }

    public function create($request)
    {
        $newDocGia = new DocGia([
            'Ten'=>$request->Ten,
            'GioiTinh' =>$request->GioiTinh,
            'NgaySinh' =>$request->NgaySinh,
            'SDT' =>$request->SDT,
            'Email' => $request->Email,
            'NguoiCN' =>Auth::user()->Ten,

        ]);
        return $newDocGia->save();
    }


    public function update($request, $id)
    {
        $DG = $this->findOne($id);
        return $DG->update([
            'Ten' =>$request->Ten ?? $DG->Ten,
            'GioiTinh' =>$request->GioiTinh ?? $DG->GioiTinh,
            'NgaySinh' =>$request->NgaySinh ?? $DG->NgaySinh,
            'SDT' =>$request->SDT ?? $DG->SDT,
            'Email' => $request->Email ?? $DG->Email,
            'NguoiCN' =>Auth::user()->Ten,

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
