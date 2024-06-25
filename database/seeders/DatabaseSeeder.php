<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Author;
use App\Models\AuthorBook;
use App\Models\Book;
use App\Models\BookState;
use App\Models\CopyBook;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Author::factory(10)->create();
        Book::factory(10)->create();
        AuthorBook::factory(10)->create();
        CopyBook::factory(10)->create();
        BookState::factory(10)->create();
    }
}
