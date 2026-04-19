<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AboutClubTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'about_club_id',
        'locale',
        'title',
        'content',
    ];

    public function aboutClub()
    {
        return $this->belongsTo(AboutClub::class);
    }
}
