<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'photo',
        'status',
    ];

    public function translations()
    {
        return $this->hasMany(MemberTranslation::class);
    }

    public function translation($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $this->hasOne(MemberTranslation::class)->where('locale', $locale);
    }
}
