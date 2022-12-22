<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PhanLoai extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;
    protected $primaryKey = 'MaPL';

    public function DauSach():HasMany
    {
        return $this->hasMany(DauSach::class, 'MaPL');
    }

    public function Sach()
    {
        return $this->hasManyThrough(Sach::class, DauSach::class, 'MaPL', 'MaDauSach', 'MaPL', 'MaDauSach');
    }
}
