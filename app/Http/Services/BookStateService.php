<?php

declare(strict_types=1);

namespace App\Http\Services;

use App\Exceptions\ApiResponseException;
use App\Http\Helpers\ErrorCodeHelper;
use App\Http\Repositories\BookStateRepository;
use App\Http\Repositories\CopyBookRepository;
use App\Models\BookState;
use App\Models\CopyBook;
use Illuminate\Database\Eloquent\Model;

class BookStateService
{
    /**
     * @param BookStateRepository $copyBookRepository
     */
    public function __construct(protected BookStateRepository $copyBookRepository)
    {
    }


    /**
     * @param array $data
     * @return BookState|null
     * @throws ApiResponseException
     */
    public function giveBook(array $data): ?BookState
    {
        $this->checkRequiredData($data);

        return $this->copyBookRepository->giveBookToReader($data);
    }


    /**
     * @param array $data
     * @return BookState|null
     * @throws ApiResponseException
     */
    public function returnCopyBook(array $data): ?BookState
    {
        $this->checkRequiredData($data);

        return $this->copyBookRepository->returnCopyBookToLibrary($data);
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
