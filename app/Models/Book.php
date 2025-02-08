<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'stock',
        'book_category_id'
    ];

    /**
     * Summary of bookCategory
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<BookCategory, Book>
     */
    public function bookCategory() {
        return $this->belongsTo(BookCategory::class, 'book_category_id', 'id');
    }

    /**
     * Summary of bookRent
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<BookRent, Book>
     */
    public function bookRent() {
        return $this->hasMany(BookRent::class, 'book_id', 'id');
    }
    
}
