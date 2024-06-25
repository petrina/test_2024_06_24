<?php

namespace Database\Factories;

use App\Models\CopyBook;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BookState>
 */
class BookStateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'copy_book_id' => CopyBook::factory()->create()->id,
            'user_id' => User::factory()->create()->id,
        ];
    }
}
