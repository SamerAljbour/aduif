<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MemoryTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'memory_id',
        'locale',
        'title',
        'description',
    ];

    public function memory()
    {
        return $this->belongsTo(Memory::class);
    }
}
