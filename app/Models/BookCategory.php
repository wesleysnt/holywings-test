<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookCategory extends Model
{
    use SoftDeletes;
    
    /**
     * Summary of fillable
     * @var array
     */
    protected $fillable = [
        'category',
    ];

    /**
     * Summary of book
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Book, BookCategory>
     */
    public function book() {
        return $this->hasMany(Book::class, 'book_category_id','id');
    }
}
