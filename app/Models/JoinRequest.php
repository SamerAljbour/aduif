<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JoinRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'phone',
        'status',
    ];

    public function translations()
    {
        return $this->hasMany(JoinRequestTranslation::class);
    }

    public function documents()
    {
        return $this->hasMany(JoinRequestDocument::class);
    }
}
