<?php

declare(strict_types=1);

namespace App\Http\Services;

use App\Exceptions\ApiResponseException;
use App\Http\Helpers\ErrorCodeHelper;
use App\Http\Repositories\BookRepository;
use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BookService
{
    /**
     * @param BookRepository $bookRepository
     */
    public function __construct(protected BookRepository $bookRepository)
    {
    }

    /**
     * @return Collection
     */
    public function getAllBooks(): Collection
    {
        return $this->bookRepository->getBooks();
    }

    /**
     * @param int $bookId
     * @return Book
     * @throws ApiResponseException
     */
    public function findBookById(int $bookId): Book
    {
        $this->checkRequiredData($bookId);

        return $this->bookRepository->getBookById($bookId);
    }

    /**
     * @param mixed $data
     * @return Book
     * @throws ApiResponseException
     */
    public function createBook(array $data): Book
    {
        $this->checkRequiredData($data);

        return $this->bookRepository->createBook($data);
    }

    /**
     * @param mixed $data
     * @param Book $book
     * @return Book
     * @throws ApiResponseException
     */
    public function updateBook(mixed $data, Book $book): Book
    {
        $this->checkRequiredData($book);

        return $this->bookRepository->updateBook($data, $book);
    }

    /**
     * @param Book $book
     * @return bool|null
     * @throws ApiResponseException
     */
    public function deleteBook(Book $book): ?bool
    {
        $this->checkRequiredData($book);

        return $this->bookRepository->deleteBook($book);
    }

    /**
     * @param mixed $data
     * @return void
     * @throws ApiResponseException
     */
    private function checkRequiredData(mixed $data): void
    {
        if (!$data) {
            ApiResponseException::makeExceptionByCode(ErrorCodeHelper::BAD_REQUEST);
        }
    }
}
