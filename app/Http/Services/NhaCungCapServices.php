<?php

namespace App\Http\Services;

use App\Models\NhaCungCap;
use Illuminate\Database\Eloquent\Collection;

class NhaCungCapServices
{
    private NhaCungCap $nhaCungCap;

    public function __construct(NhaCungCap $nhaCungCap){
        $this->nhaCungCap = $nhaCungCap;
    }

    public function findAll(): Collection
    {
        return $this->nhaCungCap->all();
    }

    public function getAllPaginate()
    {
        return $this->nhaCungCap->paginate(10);
    }

    public function findOne($id){
        return $this->nhaCungCap->find($id);
    }

    public function create($request): bool
    {
        $newNCC = new NhaCungCap([
            'TenNCC' => $request->TenNCC,
            'DiaChi' => $request->DiaChi,
            'SDT' => $request->SDT,
            'Email' => $request->Email,
        ]);

        return $newNCC->save();
    }

    public function update($id, $request): bool
    {
        $ncc = $this->findOne($id);
        $ncc->TenNCC = $request->TenNCC;
        $ncc->DiaChi = $request->DiaChi;
        $ncc->SDT = $request->SDT;
        $ncc->Email = $request->Email;
        return $ncc->update();
    }

    public function delete($id)
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
