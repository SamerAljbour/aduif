<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JoinRequestDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'join_request_id',
        'file_path',
        'type',
        'member_id',
    ];

    public function joinRequest()
    {
        return $this->belongsTo(JoinRequest::class);
    }
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
