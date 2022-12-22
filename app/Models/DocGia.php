<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\HasMany;

class DocGia extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'MaDG';

    public function viPhams(): HasMany
    {
        return $this->hasMany(ViPham::class, 'MaDG');
    }

    public function PhieuMuon(): HasMany
    {
        return $this->hasMany(PhieuMuon::class, 'MaDG');
    }
}
