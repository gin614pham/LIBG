<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Sach extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'MaSach';

    public function DauSach(): BelongsTo
    {
        return $this->belongsTo(DauSach::class, 'MaDauSach');
    }

    public function ThanhLy(): HasOne
    {
        return $this->hasOne(ThanhLy::class, 'MaSach');
    }
}
