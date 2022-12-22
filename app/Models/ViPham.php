<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method find($id)
 */
class ViPham extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'MaVP';

    public function DocGia(): BelongsTo
    {
        return $this->belongsTo(DocGia::class, 'MaDG' );
    }

}
