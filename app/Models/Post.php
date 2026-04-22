<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'event_date',
        'image',
        'type',
    ];

    // 🔗 translations relation
    public function translations()
    {
        return $this->hasMany(PostTranslation::class);
    }

    // 🔥 helper: get translation by locale
    public function translation($locale)
    {
        return $this->hasMany(PostTranslation::class)->where('locale', $locale);
    }

    // 🔥 shortcut accessors (optional but useful)
    public function getTitleArAttribute()
    {
        return $this->translations->where('locale', 'ar')->first()?->title;
    }

    public function getTitleFrAttribute()
    {
        return $this->translations->where('locale', 'fr')->first()?->title;
    }

    public function getDescriptionArAttribute()
    {
        return $this->translations->where('locale', 'ar')->first()?->description;
    }

    public function getDescriptionFrAttribute()
    {
        return $this->translations->where('locale', 'fr')->first()?->description;
    }
}
