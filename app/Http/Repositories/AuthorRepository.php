<?php

namespace App\Http\Repositories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class AuthorRepository
{
    public function __construct(protected Author $author)
    {
    }

    /**
     * @return Collection
     */
    public function getAuthors(): Collection
    {
        return $this->author::query()->get(['name', 'surname', 'patronymic']);
    }


    /**
     * @param int $authorId
     * @return Author
     */
    public function getAuthorById(int $authorId): Author
    {
        /** @var Author $author */
        $author = $this->author::query()->select('name', 'surname', 'patronymic')->find($authorId);
        return $author;
    }


    /**
     * @param array $data
     * @return Author
     */
    public function createAuthor(array $data): Author
    {
        /** @var Author $author */
        $author = $this->author::query()->firstOrCreate($data);
        return $author;
    }


    /**
     * @param array $data
     * @param Author $author
     * @return Author
     */
    public function updateAuthor(array $data, Author $author): Author
    {
        $author->update($data);
        return $author->fresh();
    }

    /**
     * @param Author $author
     * @return bool|null
     */
    public function deleteAuthor(Author $author): ?bool
    {
        return $author->delete();
    }
}
