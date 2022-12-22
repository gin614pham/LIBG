<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PhieuMuon extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'MaPhieuMuon';

    public function Sach():BelongsTo
    {
        return $this->belongsTo(Sach::class, 'MaSach');
    }

    public function DocGia():BelongsTo
    {
        return $this->belongsTo(DocGia::class, 'MaDG');
    }
}
