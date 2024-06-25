<?php

declare(strict_types=1);

namespace App\Http\Repositories;

use App\Models\BookState;
use App\Models\CopyBook;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class BookStateRepository
{
    /**
     * @param array $data
     * @return BookState|null
     */
    public function giveBookToReader(array $data): ?BookState
    {
        $copyBook = CopyBook::query()->findOrFail($data['copy_book_id']);

        if (BookState::query()
            ->where('copy_book_id', '=', $copyBook->id)
            ->whereNotNull('in_time')
            ->whereNull('out_time')
            ->exists()
        ) {
            return null;
        }

        /** @var BookState $bookState */
        $bookState =  BookState::query()->create(
            [
                'copy_book_id' => $copyBook->id,
                'user_id' => $data['user_id'],
                'in_time' => Carbon::now(),
                'out_time' => null,
            ]
        );
        return $bookState;
    }

    /**
     * @param array $data
     * @return BookState|null
     */
    public function returnCopyBookToLibrary(array $data): ?BookState
    {
        /** @var BookState $bookState */
        $bookState = BookState::query()
            ->where('copy_book_id', '=', $data['copy_book_id'])
            ->whereNotNull('in_time')
            ->whereNull('out_time')
            ->first();

        if ($bookState === null) {
            return null;
        }

        $updated = $bookState->update([
            'out_time' => Carbon::now()
        ]);

        return ($updated) ? $bookState : null;
    }
}
