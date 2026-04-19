<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'event_date',
    ];

    public function translations()
    {
        return $this->hasMany(NewsTranslation::class);
    }

    public function translation($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $this->hasOne(NewsTranslation::class)->where('locale', $locale);
    }
}
