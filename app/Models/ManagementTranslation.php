<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ManagementTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'management_id',
        'locale',
        'name',
        'bio',
    ];

    public function management()
    {
        return $this->belongsTo(Management::class);
    }
}
