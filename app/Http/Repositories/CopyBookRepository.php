<?php

declare(strict_types=1);

namespace App\Http\Repositories;

use App\Models\Book;
use App\Models\CopyBook;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CopyBookRepository
{

    /**
     * @return Collection
     */
    public function getCopyBooks(): Collection
    {
        return CopyBook::with(['book.authors'])->get();
    }


    /**
     * @param CopyBook $copyBook
     * @return CopyBook
     */
    public function getCopyBookById(CopyBook $copyBook): CopyBook
    {
        return CopyBook::with(['book.authors'])->get()->find($copyBook);
    }


    /**
     * @param array $data
     * @return CopyBook
     */
    public function createCopyBook(array $data): CopyBook
    {
        $book = Book::query()->findOrFail($data['book_id']);

        /** @var CopyBook $copyBook */
        $copyBook = CopyBook::query()->create([
            'book_id' => $book->id,
            'inventory_number' => $data['inventory_no'],
        ]);
        return $copyBook;
    }


    /**
     * @param array $data
     * @param int $copyBookId
     * @return CopyBook
     */
    public function updateCopyBook(array $data, int $copyBookId): CopyBook
    {
        /** @var CopyBook $copyBook */
        $copyBook = CopyBook::query()->findOrFail($copyBookId);

        $copyBook->update([
            'inventory_number' => $data['inventory_no'],
        ]);

        return $copyBook;
    }

    /**
     * @param CopyBook $copyBook
     * @return bool
     */
    public function deleteCopyBook(CopyBook $copyBook): bool
    {
        $copyBook->borrowed_at = Carbon::now();
        return $copyBook->save();
    }
}
