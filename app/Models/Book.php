<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';
    protected $fillable = ['id', 'title','description'];


    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class, 'author_books', 'book_id', 'author_id');
    }
}
