<?php

namespace App\Models\Scope;

use Illuminate\Database\Query\Builder;

/**
 * Trait BookScope
 * @package App\Models\Scopes
 *
 * @method Builder|self subscribeAuthors(array $authors_id)
 * @method Builder|self subscribeGenres(array $genres_id)
 * @method Builder|self subscribeNew(string $date)
 */
trait BookScope {
    /**
     * @param Builder $query
     * @param array $authorIDs
     *
     * @return Builder
     */
    public function scopeSubscribeAuthors(Builder $query, array $authorIDs): Builder
    {
        return $query->whereIn('author_id', $authorIDs);
    }

    /**
     * @param Builder $query
     * @param  array $genreIDs
     *
     * @return Builder
     */
    public function scopeSubscribeGenres(Builder $query, array $genreIDs): Builder
    {
        return $query->whereIn('genre_id', $genreIDs);
    }
}
