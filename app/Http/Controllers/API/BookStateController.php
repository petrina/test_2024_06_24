<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Exceptions\ApiResponseException;
use App\Http\Controllers\Controller;
use App\Http\Requests\GiveBookStateRequest;
use App\Http\Requests\ReturnBookStateRequest;
use App\Http\Resources\BookStateResource;
use App\Http\Services\BookStateService;

class BookStateController extends Controller
{
    /**
     * @param BookStateService $bookStateService
     */
    public function __construct(protected BookStateService $bookStateService)
    {
    }


    /**
     * @param GiveBookStateRequest $request
     * @return BookStateResource
     * @throws ApiResponseException
     */
    public function giveBookToReader(GiveBookStateRequest $request): BookStateResource
    {
        $data = $request->validated();

        return BookStateResource::make($this->bookStateService->giveBook($data));
    }


    /**
     * @param ReturnBookStateRequest $request
     * @return BookStateResource
     * @throws ApiResponseException
     */
    public function returnCopyBookToLibrary(ReturnBookStateRequest $request): BookStateResource
    {
        $data = $request->validated();

        return BookStateResource::make($this->bookStateService->returnCopyBook($data));
    }
}
