<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JoinRequestTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'join_request_id',
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
    public function joinRequest()
    {
        return $this->belongsTo(JoinRequest::class);
    }
}
