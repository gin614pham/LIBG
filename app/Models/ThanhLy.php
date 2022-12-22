<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ThanhLy extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'MaThanhLy';

    public function Sach(): BelongsTo
    {
        return $this->belongsTo(Sach::class, 'MaSach');
    }
}
