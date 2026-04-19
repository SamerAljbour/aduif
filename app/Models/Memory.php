<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Memory extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'event_date',
    ];

    public function translations()
    {
        return $this->hasMany(MemoryTranslation::class);
    }

    public function translation($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $this->hasOne(MemoryTranslation::class)->where('locale', $locale);
    }
}
