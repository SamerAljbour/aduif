<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Management extends Model
{
    protected $table = 'managements';
    protected $fillable = [
        'photo',
        'email',
        'position',
        'parent_id',
        'order',
        'type',
    ];

    /** Children in the hierarchy */
    public function children(): HasMany
    {
        return $this->hasMany(Management::class, 'parent_id')
            ->orderBy('order');
    }

    /** All descendants recursively */
    public function allChildren(): HasMany
    {
        return $this->children()->with('allChildren.translations');
    }

    /** Parent node */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Management::class, 'parent_id');
    }

    /** Translations */
    public function translations(): HasMany
    {
        return $this->hasMany(ManagementTranslation::class);
    }

    /** Get translation for a given locale (falls back to 'en') */
    public function translation(string $locale = null): ?ManagementTranslation
    {
        $locale = $locale ?? app()->getLocale();
        return $this->translations->firstWhere('locale', $locale)
            ?? $this->translations->firstWhere('locale', 'en');
    }

    /** Human-readable position labels */
    public static function positionLabel(string $position): string
    {
        return match ($position) {
            'president'      => 'رئيس النادي',
            'vice_president' => 'نائب الرئيس',
            'secretary'      => 'أمين السر',
            'treasurer'      => 'أمين الصندوق',
            'board_member'   => 'عضو هيئة إدارية',
            default          => $position,
        };
    }

    /** Position hierarchy order */
    public static function positionOrder(): array
    {
        return [
            'president'      => 1,
            'vice_president' => 2,
            'secretary'      => 3,
            'treasurer'      => 4,
            'board_member'   => 5,
        ];
    }
}
