<?php

declare(strict_types=1);

namespace App\Http\Repositories;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BookRepository
{

    public function __construct(protected Book $book)
    {
    }

    /**
     * @return Collection
     */
    public function getBooks(): Collection
    {
        return Book::with(['authors:id,name,surname'])->get(['id', 'title', 'description']);
    }


    /**
     * @param int $bookId
     * @return Book
     */
    public function getBookById(int $bookId): Book
    {
        return Book::with(['authors:id,name,surname'])->get(['id', 'title', 'description'])->find($bookId);
    }


    /**
     * @param array $data
     * @return Book
     */
    public function createBook(array $data): Book
    {
        /** @var Book $book */
        $book = Book::query()->create([
            'title' => $data['title'],
            'description' => $data['description'],
        ]);

        $authorIds = $this->getAuthorIds($data);
        $book->authors()->attach($authorIds);
        return $book;
    }


    /**
     * @param array $data
     * @param Book $book
     * @return Book
     */
    public function updateBook(array $data, Book $book): Book
    {
        $book->update([
            'title' => $data['title'],
            'description' => $data['description'],
        ]);

        $authorIds = $this->getAuthorIds($data);
        $book->authors()->sync($authorIds);
        return $book;
    }


    /**
     * @param Book $book
     * @return bool|null
     */
    public function deleteBook(Book $book): ?bool
    {
        $book->authors()->detach();

        return $book->delete();
    }

    /**
     * @param array $data
     * @return array
     */
    private function getAuthorIds(array $data): array
    {
        $authorIds = [];

        foreach ($data['author_ids'] as $authorId) {
            $author = Author::find($authorId);

            if (!$author) {
                $author = Author::query()->create([
                    'name' => $data['author_name'],
                    'surname' => $data['author_surname'],
                ]);
            }

            $authorIds[] = $author->id;
        }

        return $authorIds;
    }
}
