<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JoinRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'nationality',
        'photo',
        'cv',
        'status',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function translations()
    {
        return $this->hasMany(JoinRequestTranslation::class);
    }

    public function translation($locale = null)
    {
        $locale = $locale ?? app()->getLocale();

        return $this->hasOne(JoinRequestTranslation::class)
            ->where('locale', $locale);
    }

    public function documents()
    {
        return $this->hasMany(JoinRequestDocument::class);
    }
}
