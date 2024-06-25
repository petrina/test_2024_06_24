<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Exceptions\ApiResponseException;
use App\Http\Controllers\Controller;
use App\Http\Requests\CopyBookRequest;
use App\Http\Resources\CopyBookResource;
use App\Http\Services\CopyBookService;
use App\Models\CopyBook;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CopyBookController extends Controller
{
    /**
     * @param CopyBookService $copyBookService
     */
    public function __construct(protected CopyBookService $copyBookService)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return CopyBookResource::collection($this->copyBookService->getCopyBooks());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param CopyBookRequest $request
     * @return CopyBookResource
     * @throws ApiResponseException
     */
    public function store(CopyBookRequest $request): CopyBookResource
    {
        $data = $request->validated();

        return CopyBookResource::make($this->copyBookService->createCopyBook($data));
    }

    /**
     *  Display the specified resource.
     *
     * @param CopyBook $copyBook
     * @return CopyBookResource
     * @throws ApiResponseException
     */
    public function show(CopyBook $copyBook): CopyBookResource
    {
        return CopyBookResource::make($this->copyBookService->findCopyBookById($copyBook));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CopyBookRequest $request
     * @param int $copyBookId
     * @return CopyBookResource
     */
    public function update(CopyBookRequest $request, int $copyBookId): CopyBookResource
    {
        $data = $request->validated();

        return CopyBookResource::make($this->copyBookService->updateCopyBook($data, $copyBookId));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param CopyBook $copyBook
     * @return JsonResponse
     * @throws ApiResponseException
     */
    public function destroy(CopyBook $copyBook): JsonResponse
    {
        $this->copyBookService->deleteCopyBook($copyBook);
        return response()->json([
            'message' => 'The copy of book was successfully borrowed.'
        ]);
    }
}
