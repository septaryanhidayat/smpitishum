<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'excerpt',
        'status',
        'type',
        'featured_image',
        'views_count',
        'author_id',
        'published_at',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'views_count' => 'integer',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'post_category');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'post_tag');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'publish');
    }

    public function scopePosts($query)
    {
        return $query->where('type', 'post');
    }

    public function scopeArticles($query)
    {
        return $query->where('type', 'post');
    }

    public function scopePrestasi($query)
    {
        return $query->where('type', 'prestasi');
    }

    public function scopeAgendas($query)
    {
        return $query->where('type', 'agenda');
    }

    public function scopePages($query)
    {
        return $query->where('type', 'page');
    }

    public function getPublicUrlAttribute(): string
    {
        return match ($this->type) {
            'prestasi' => route('prestasi.show', $this->slug),
            'ekskul' => route('ekskul.show', $this->slug),
            'page' => url('/'.$this->slug),
            default => route('artikel.show', $this->slug),
        };
    }

    public function getFeaturedImageUrlAttribute(): string
    {
        if (! empty($this->featured_image)) {
            $path = parse_url($this->featured_image, PHP_URL_PATH);

            return '/'.ltrim($path, '/');
        }

        return '/uploads/campus-smpit-ishum.webp';
    }

    public function getPostDateAttribute()
    {
        return $this->published_at ?? $this->created_at;
    }
}
