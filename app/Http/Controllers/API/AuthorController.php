<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Exceptions\ApiResponseException;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthorRequest;
use App\Http\Resources\AuthorResource;
use App\Http\Services\AuthorService;
use App\Models\Author;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AuthorController extends Controller
{
    /**
     * @param AuthorService $authorService
     */
    public function __construct(protected AuthorService $authorService)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return AuthorResource::collection($this->authorService->getAllAuthors());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param AuthorRequest $request
     * @return AuthorResource
     * @throws ApiResponseException
     */
    public function store(AuthorRequest $request): AuthorResource
    {
        $data = $request->validated();

        return AuthorResource::make($this->authorService->createAuthor($data));
    }

    /**
     *  Display the specified resource.
     *
     * @param int $authorId
     * @return AuthorResource
     * @throws ApiResponseException
     */
    public function show(int $authorId): AuthorResource
    {
        return AuthorResource::make($this->authorService->findAuthorById($authorId));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AuthorRequest $request
     * @param Author $author
     * @return AuthorResource
     * @throws ApiResponseException
     */
    public function update(AuthorRequest $request, Author $author): AuthorResource
    {
        $data = $request->validated();
        return AuthorResource::make($this->authorService->updateAuthor($data, $author));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Author $author
     * @return JsonResponse
     * @throws ApiResponseException
     */
    public function destroy(Author $author): JsonResponse
    {
        $this->authorService->deleteAuthor($author);
        return response()->setStatusCode(204)->json([
            'message' => 'The author was successfully deleted.'
        ]);
    }
}
