<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookRent extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'book_id',
        'member_id',
        'due_date',
        'return_date',
    ];

    /**
     * Summary of book
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Book, BookRent>
     */
    public function book() {
        return $this->belongsTo(Book::class, 'book_id','id');
    }

    /**
     * Summary of member
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Member, BookRent>
     */
    public function member() {
        return $this->belongsTo(Member::class,'member_id','id');
    }
}
