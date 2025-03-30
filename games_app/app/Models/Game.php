<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'developer',
        'genre',
        'release_date',
        'platform',
        'price',
        'cover',
    ];
    public function scopeFilterByTitle(Builder $query, ?string $title): Builder
    {
        return $title ? $query->where('title', 'like', "%{$title}%") : $query;
    }


    public function scopeFilterByGenre(Builder $query, ?string $genre): Builder
    {
        return $genre ? $query->where('genre', 'like', "%{$genre}%") : $query;
    }


    public function scopeFilterByPlatform(Builder $query, ?string $platform): Builder
    {
        return $platform ? $query->where('platform', 'like', "%{$platform}%") : $query;
    }

    public function scopeApplyFilters(Builder $query, array $filters): Builder
    {
        return $query
            ->filterByTitle($filters['title'] ?? null)
            ->filterByGenre($filters['genre'] ?? null)
            ->filterByPlatform($filters['platform'] ?? null);
    }

}
