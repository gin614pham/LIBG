<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method find($id)
 */
class DauSach extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'MaDauSach';

    public function Sach() : HasMany {
        return $this->hasMany(Sach::class, 'MaDauSach');
    }

    public function PhieuNhap(): HasMany {
        return $this->hasMany(PhieuNhap::class, 'MaDauSach');
    }

    public function TheLoai() : BelongsTo {
        return $this->belongsTo(TheLoai::class, 'MaTL');
    }

    public function NgonNgu() : BelongsTo {
        return $this->belongsTo(NgonNgu::class, 'MaNN');
    }

    public function PhanLoai() : BelongsTo {
        return $this->belongsTo(PhanLoai::class, 'MaPL');
    }





}
