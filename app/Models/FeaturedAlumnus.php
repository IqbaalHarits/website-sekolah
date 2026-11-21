<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class FeaturedAlumnus extends Model
{
    protected $table = 'featured_alumni';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'graduation_year' => 'integer',
            'order' => 'integer',
            'is_featured' => 'boolean',
        ];
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true)->orderBy('order');
    }
}
