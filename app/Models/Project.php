<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'image',
    ];

    public function translations()
    {
        return $this->hasMany(ProjectTranslation::class);
    }

    public function translation($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $this->hasOne(ProjectTranslation::class)->where('locale', $locale);
    }
}
