<?php

namespace App\Services\Actions;

use App\DTO\SubscribeDto;
use App\Http\Requests\Filters\BookFilter;
use App\Models\Book;
use App\Models\Scope\BookScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class BookActionService {
    /**
     * @param BookFilter $filter
     * @return Collection
     */
    public function fetchByFilter(BookFilter $filter): Collection {
        /* @var BookScope|Builder $query */
        $query = Book::query();

        if($filter->hasAuthors())
            $query->subscribeAuthors($filter->getAuthorsIDs());

        if($filter->hasGenres())
            $query->subscribeGenres($filter->getGenreIDs());

        return $query->get();
    }

    public function fetchBooksSubscribeAuthors(SubscribeDto $dto)
    {


        return Book::query()->booksSubscribeAuthors((array)$dto->getAuthorsId())->get();
    }

    public function fetchBooksSubscribeGenres(SubscribeDto $dto)
    {
        $bookFilterItem = new BookFilter($dto->getGenresId());

        return Book::query()->booksSubscribeGenres($bookFilterItem->getParam());
    }

    public function fetchSubscribeGenres($param = null)
    {
        $bookFilterItem = new BookFilter($param);

        return Book::query()->booksSubscribeNew($bookFilterItem->getDate());
    }
}
