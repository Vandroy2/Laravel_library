<?php

namespace App\Http\Requests\Filters;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class BookFilter {
    /**
     * @var array
     */
    protected $authorsIDs;

    /**
     * @var array
     */
    protected $genreIDs;

    /**
     * @param array $authorsIDs
     * @param array $genreIDs
     */
    public function __construct(array $authorsIDs, array $genreIDs) {
        $this->authorsIDs = $authorsIDs;
        $this->genreIDs = $genreIDs;
    }

    /**
     * @return array
     */
    public function getAuthorsIDs(): array {
        return $this->authorsIDs;
    }

    /**
     * @return bool
     */
    public function hasAuthors(): bool {
        return !empty($this->authorsIDs);
    }

    /**
     * @return array
     */
    public function getGenreIDs(): array {
        return $this->genreIDs;
    }

    /**
     * @return bool
     */
    public function hasGenres(): bool {
        return !empty($this->genreIDs);
    }

    /**
     * @param  Request $request
     * @return static
     */
    public static function createByRequest(Request $request): self{
        return new self(
            Arr::wrap($request->get('authors_id', [])),
            Arr::wrap($request->get('genres_id', []))
        );
    }
}
