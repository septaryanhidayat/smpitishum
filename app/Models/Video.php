<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'youtube_url',
        'youtube_id',
        'description',
    ];

    protected static function booted(): void
    {
        static::saving(function (Video $video) {
            $extractedId = static::extractYoutubeId($video->youtube_id ?: $video->youtube_url);
            if ($extractedId) {
                $video->youtube_id = $extractedId;
                if (empty($video->youtube_url) || ! filter_var($video->youtube_url, FILTER_VALIDATE_URL)) {
                    $video->youtube_url = "https://www.youtube.com/watch?v={$extractedId}";
                }
            }
        });
    }

    /**
     * Ekstrak YouTube Video ID (11 karakter) dari berbagai format URL YouTube
     * (youtube.com/watch?v=, youtu.be/, shorts/, live/, embed/, iframe tag, ID langsung).
     */
    public static function extractYoutubeId(?string $url): ?string
    {
        if (empty($url)) {
            return null;
        }

        $url = trim(html_entity_decode($url, ENT_QUOTES | ENT_HTML5, 'UTF-8'));

        // Jika user langsung memasukkan 11 karakter ID video YouTube
        if (preg_match('/^[a-zA-Z0-9_-]{11}$/', $url)) {
            return $url;
        }

        // Jika user paste kode tag iframe embed
        if (preg_match('/src=["\']([^"\']+)["\']/i', $url, $iframeMatch)) {
            $url = $iframeMatch[1];
        }

        // Ekstrak ID 11 karakter dari berbagai macam varian URL YouTube
        $pattern = '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?|shorts|live)/|.*[?&]v=)|youtu\.be/)([^"&?/\s]{11})%i';
        if (preg_match($pattern, $url, $matches)) {
            return $matches[1];
        }

        return null;
    }

    /**
     * Otomatis ambil YouTube ID dari kolom youtube_id atau parsing dari youtube_url jika kosong.
     */
    public function getYoutubeIdAttribute($value): ?string
    {
        if (! empty($value) && preg_match('/^[a-zA-Z0-9_-]{11}$/', trim($value))) {
            return trim($value);
        }

        return static::extractYoutubeId($this->youtube_url);
    }

    /**
     * URL Thumbnail resmi YouTube resolusi tinggi.
     */
    public function getThumbnailUrlAttribute(): string
    {
        $id = $this->youtube_id;
        if ($id) {
            return "https://img.youtube.com/vi/{$id}/hqdefault.jpg";
        }

        return '/uploads/campus-smpit-ishum.webp';
    }

    /**
     * URL Embed resmi YouTube.
     */
    public function getEmbedUrlAttribute(): string
    {
        $id = $this->youtube_id;
        if ($id) {
            return "https://www.youtube.com/embed/{$id}";
        }

        return '';
    }
}
