<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Portfolio extends Model
{
    protected $fillable = [
        'service_id',
        'title',
        'slug',
        'client',
        'location',
        'published_at',
        'cover_image',
        'excerpt',
        'description',
        'challenge',
        'solution',
        'summary',
        'gallery',
        'tags',
        'technologies',
        'features',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'published_at' => 'date',
        'gallery'      => 'array',
        'tags'         => 'array',
        'technologies' => 'array',
        'features'     => 'array',
        'is_active'    => 'boolean',
    ];

    protected static function booted(): void
    {
        static::creating(function (self $model) {
            $model->slug ??= Str::slug($model->title);
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }
}
