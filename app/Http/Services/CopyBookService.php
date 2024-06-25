<?php

declare(strict_types=1);

namespace App\Http\Services;

use App\Exceptions\ApiResponseException;
use App\Http\Helpers\ErrorCodeHelper;
use App\Http\Repositories\CopyBookRepository;
use App\Models\CopyBook;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CopyBookService
{
    /**
     * @param CopyBookRepository $copyBookRepository
     */
    public function __construct(protected CopyBookRepository $copyBookRepository)
    {
    }

    /**
     * @return Collection
     */
    public function getCopyBooks(): Collection
    {
        return $this->copyBookRepository->getCopyBooks();
    }

    /**
     * @param CopyBook $copyBook
     * @return CopyBook
     * @throws ApiResponseException
     */
    public function findCopyBookById(CopyBook $copyBook): CopyBook
    {
        $this->checkRequiredData($copyBook);

        return $this->copyBookRepository->getCopyBookById($copyBook);
    }

    /**
     * @param mixed $data
     * @return CopyBook
     * @throws ApiResponseException
     */
    public function createCopyBook(array $data): CopyBook
    {
        $this->checkRequiredData($data);

        return $this->copyBookRepository->createCopyBook($data);
    }

    /**
     * @param mixed $data
     * @param int $copyBookId
     * @return CopyBook
     * @throws ApiResponseException
     */
    public function updateCopyBook(mixed $data, int $copyBookId): CopyBook
    {
        $this->checkRequiredData($copyBookId);

        return $this->copyBookRepository->updateCopyBook($data, $copyBookId);
    }

    /**
     * @param CopyBook $copyBook
     * @return bool
     * @throws ApiResponseException
     */
    public function deleteCopyBook(CopyBook $copyBook): bool
    {
        $this->checkRequiredData($copyBook);

        return $this->copyBookRepository->deleteCopyBook($copyBook);
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
