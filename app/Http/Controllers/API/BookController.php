<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Exceptions\ApiResponseException;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Http\Resources\BookResource;
use App\Http\Services\BookService;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BookController extends Controller
{
    /**
     * @param BookService $bookService
     */
    public function __construct(protected BookService $bookService)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return BookResource::collection($this->bookService->getAllBooks());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param BookRequest $request
     * @return BookResource
     * @throws ApiResponseException
     */
    public function store(BookRequest $request): BookResource
    {
        $data = $request->validated();

        return BookResource::make($this->bookService->createBook($data));
    }

    /**
     *  Display the specified resource.
     *
     * @param int $bookId
     * @return BookResource
     * @throws ApiResponseException
     */
    public function show(int $bookId): BookResource
    {
        return BookResource::make($this->bookService->findBookById($bookId));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BookRequest $request
     * @param Book $book
     * @return BookResource
     * @throws ApiResponseException
     */
    public function update(BookRequest $request, Book $book): BookResource
    {
        $data = $request->validated();

        return BookResource::make($this->bookService->updateBook($data, $book));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Book $book
     * @return JsonResponse
     * @throws ApiResponseException
     */
    public function destroy(Book $book): JsonResponse
    {
        $this->bookService->deleteBook($book);
        return response()->setStatusCode(204)->json([
            'message' => 'The book was successfully deleted.'
        ]);
    }
}
