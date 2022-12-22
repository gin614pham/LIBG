<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PhieuNhap extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'MaPhieuNhap';

    public function NhaCungCap():BelongsTo
    {
        return $this->belongsTo(NhaCungCap::class, 'MaNCC',);
    }

    public function DauSach():BelongsTo
    {
        return $this->belongsTo(DauSach::class, 'MaDauSach');
    }
}
