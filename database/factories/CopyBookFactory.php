<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\CopyBook;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CopyBook>
 */
class CopyBookFactory extends Factory
{
    protected $model = CopyBook::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'book_id' => Book::factory()->create()->id,
            'inventory_number' => $this->faker->name(),
        ];
    }
}
