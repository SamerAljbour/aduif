<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'facebook_link',
    ];

    public function translations()
    {
        return $this->hasMany(ContactTranslation::class);
    }

    public function translation($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $this->hasOne(ContactTranslation::class)->where('locale', $locale);
    }
}
