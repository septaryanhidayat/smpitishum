<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PpdbTrack extends Model
{
    use HasFactory;

    protected $table = 'ppdb_tracks';

    protected $fillable = [
        'name',
        'slug',
        'percentage',
        'quota',
        'cashback_info',
        'description',
        'order',
        'is_active',
    ];

    protected $casts = [
        'order' => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * Scope for active tracks.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope ordered tracks.
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('order', 'asc')->orderBy('id', 'asc');
    }

    /**
     * Formatted label with percentage.
     */
    public function getFormattedLabelAttribute(): string
    {
        if (! empty($this->percentage) && $this->percentage !== '0%') {
            return "{$this->name} ({$this->percentage})";
        }

        return $this->name;
    }
}
