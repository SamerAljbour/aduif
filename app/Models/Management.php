<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Management extends Model
{
    use HasFactory;

    protected $fillable = [
        'photo',
        'email',
        'position',
        'type',
        'start_date',
        'end_date',
    ];

    public function translations()
    {
        return $this->hasMany(ManagementTranslation::class);
    }

    public function translation($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $this->hasOne(ManagementTranslation::class)->where('locale', $locale);
    }
}
