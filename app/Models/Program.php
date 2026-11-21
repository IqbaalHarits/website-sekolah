<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    public const TYPE_UNGGULAN = 'program_unggulan';
    public const TYPE_EKSKUL = 'ekstrakurikuler';

    public const TYPES = [
        self::TYPE_UNGGULAN => 'Program Unggulan',
        self::TYPE_EKSKUL => 'Ekstrakurikuler',
    ];

    protected $guarded = [];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('order');
    }

    public function scopeOfType(Builder $query, string $type): Builder
    {
        return $query->where('type', $type);
    }
}
