<?php

declare(strict_types=1);

namespace App\Http\Services;

use App\Exceptions\ApiResponseException;
use App\Http\Helpers\ErrorCodeHelper;
use App\Http\Repositories\AuthorRepository;
use App\Models\Author;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class AuthorService
{
    /**
     * @param AuthorRepository $authorRepository
     */
    public function __construct(protected AuthorRepository $authorRepository)
    {
    }

    /**
     * @return Collection
     */
    public function getAllAuthors(): Collection
    {
        return $this->authorRepository->getAuthors();
    }

    /**
     * @param int $authorId
     * @return Author
     * @throws ApiResponseException
     */
    public function findAuthorById(int $authorId): Author
    {
        $this->checkRequiredData($authorId);

        return $this->authorRepository->getAuthorById($authorId);
    }

    /**
     * @param mixed $data
     * @return Author
     * @throws ApiResponseException
     */
    public function createAuthor(array $data): Author
    {
        $this->checkRequiredData($data);

        return $this->authorRepository->createAuthor($data);
    }

    /**
     * @param mixed $data
     * @param Author $author
     * @return Author
     * @throws ApiResponseException
     */
    public function updateAuthor(mixed $data, Author $author): Author
    {
        $this->checkRequiredData($author);

        return $this->authorRepository->updateAuthor($data, $author);
    }

    /**
     * @param Author $author
     * @return bool|null
     * @throws ApiResponseException
     */
    public function deleteAuthor(Author $author): ?bool
    {
        $this->checkRequiredData($author);

        return $this->authorRepository->deleteAuthor($author);
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
