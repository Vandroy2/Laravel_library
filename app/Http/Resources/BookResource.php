<?php

namespace App\Http\Resources;

use App\Models\Book;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request $request
     *
     * @return array|Arrayable|\JsonSerializable
     */
    public function toArray($request) {
        /* @var Book|self $this */
        return [
            'id' => $this->id,
            'book_name' => $this->book_name,
            'books_limit' => $this->books_limit,
            'books_number' => $this->books_number,
            'num_pages' => $this->num_pages,
            'created_date' => $this->created_date,
            'author_id' => $this->author_id,
            'library_id' => $this->library_id,
            'favorite' => $this->favorite,
        ];
    }
}
