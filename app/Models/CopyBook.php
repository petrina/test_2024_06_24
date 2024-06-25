<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CopyBook extends Model
{
    use HasFactory;

    protected $table = 'copy_books';
    public $timestamps = false;

    protected $fillable = ['id', 'book_id', 'inventory_number', 'borrowed_at'];

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }
}
