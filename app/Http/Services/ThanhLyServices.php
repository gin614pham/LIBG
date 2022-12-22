<?php

namespace App\Http\Services;

use App\Models\ThanhLy;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ThanhLyServices {
    private ThanhLy $thanhLy;

    public function __construct(ThanhLy $thanhLy)
    {
        $this->thanhLy = $thanhLy;
    }

    public function findAll()
    {
    return $this->thanhLy->all();
    }

    public function getAllPaginate()
    {
        return $this->thanhLy->paginate(10);
    }

    public function findOne($id)
    {
        return $this->thanhLy->find($id);
    }

    public function create($id, $lydo): JsonResponse
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $newThanhLy = new ThanhLy([
            'MaSach' => $id,
            'LyDo' => $lydo,
            'NguoiTL' => auth()->user()->Ten,
            'NgayTL' => date("Y-m-d"),
        ]);
        if($newThanhLy->save())return
            response()->json([
                'check' => true,
                'message' => 'ok'
            ], 200);
        return
            response()->json([
                'check' => false,
                'message' => '!ok'
            ], 400);
    }

    public function update($id, $lydo): JsonResponse
    {
        $item = $this->findOne($id);
        if ($item){
            if($item->update([
                'LyDo' => $lydo ?? $item->LyDo,
            ]))return
                response()->json([
                    'check' => true,
                    'lydo' => $item->LyDo,
                    'message' => 'ok',
                ], 200);
            return
                response()->json([
                    'check' => false,
                    'message' => '!ok'
                ], 400);
        }
        return response()->json([
            'check' => false,
            'message' => '!ok'
        ], 400);
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
