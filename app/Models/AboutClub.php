<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AboutClub extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
    ];

    public function translations()
    {
        return $this->hasMany(AboutClubTranslation::class);
    }

    public function translation($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $this->hasOne(AboutClubTranslation::class)->where('locale', $locale);
    }
}
