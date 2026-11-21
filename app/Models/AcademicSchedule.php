<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class AcademicSchedule extends Model
{
    public const CATEGORY_TAHUNAN = 'tahunan';
    public const CATEGORY_KALENDER = 'kalender_akademik';

    public const CATEGORIES = [
        self::CATEGORY_TAHUNAN => 'Jadwal Kegiatan Tahunan',
        self::CATEGORY_KALENDER => 'Kalender Akademik',
    ];

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'is_active' => 'boolean',
        ];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeCategory(Builder $query, string $category): Builder
    {
        return $query->where('category', $category);
    }

    public function scopeUpcoming(Builder $query): Builder
    {
        return $query->whereDate('start_date', '>=', today())->orderBy('start_date');
    }
}
