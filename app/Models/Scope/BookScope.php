<?php

namespace App\Models\Scope;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use phpDocumentor\Reflection\Types\Integer;


/**
 * Trait BookScope
 * @package App\Models\Scopes
 *
 * @method Builder|self subscribeAuthors(Integer $authorId)
 * @method Builder|self subscribeGenres(Integer $genreId)
 * @method Builder|self onlineLibraryBooks($searchBook)
 * @method Builder|self subscribeNew

 */
trait BookScope {
    /**
     * @param Builder $query
     * @param int $authorId
     * @return Builder
     */
    public function scopeSubscribeAuthors(Builder $query, int $authorId): Builder
    {
        return $query->where('author_id', '=', $authorId);
    }

    /**
     * @param Builder $query
     * @param int $genreId
     * @return Builder
     */
    public function scopeSubscribeGenres(Builder $query, int $genreId): Builder
    {
        return $query->where('genre_id','=', $genreId);
    }

    /**
     * @param Builder $query
     * @return Builder
     */

    public function scopeSubscribeNew(Builder $query): Builder
    {
        $date = Carbon::parse('2022-01-01 00:00:00');

        return $query->where('created_at', '>', $date);
    }

    /**
     * @param Builder $query
     * @param $request
     * @return Builder|mixed
     */

    public function scopeOnlineLibraryBooks(Builder $query, $request)
    {
        $searchBook = $request->input('search_book');

        return $query
            ->select('books.*')
            ->with(['author', 'images'])
            ->when(!empty($search_book), function ($query) use ($searchBook) {
                return $query
                    ->Join('authors', 'books.author_id', '=', 'authors.id')
                    ->join('libraries', 'books.library_id', '=', 'libraries.id')
                    ->where('books.book_name', 'like', "%$searchBook%")
                    ->orwhere('authors.author_name', 'like', "%$searchBook%")
                    ->orwhere('authors.author_surname', 'like', "%$searchBook%")
                    ->orwhere('libraries.library_name', 'like', "%$searchBook%");
            });
    }


}
