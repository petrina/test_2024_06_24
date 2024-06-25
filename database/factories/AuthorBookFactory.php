<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\AuthorBook;
use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AuthorBook>
 */
class AuthorBookFactory extends Factory
{
    protected $model = AuthorBook::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'author_id' => Author::factory()->create()->id,
            'book_id' => Book::factory()->create()->id,
        ];
    }
}
