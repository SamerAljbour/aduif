<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'contact_id',
        'locale',
        'name',
        'message',
    ];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}
