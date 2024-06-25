<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookState extends Model
{
    use HasFactory;

    protected $table = 'book_states';
    public $timestamps = false;

    protected $fillable = ['id', 'user_id', 'copy_book_id', 'in_time', 'out_time'];

    public function copyBook(): BelongsTo
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function copyBooks(): BelongsTo
    {
        return $this->belongsTo(CopyBook::class, 'copy_book_id', 'id');
    }
}
