<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MemberTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'locale',
        'name',
        'specialization',
        'degree',
        'graduation_university',
        'current_job',
        'workplace',
        'interests',
        'bio',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
