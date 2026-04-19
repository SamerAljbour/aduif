<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NewsTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'news_id',
        'locale',
        'title',
        'description',
    ];

    public function news()
    {
        return $this->belongsTo(News::class);
    }
}
