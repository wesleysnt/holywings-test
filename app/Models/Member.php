<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
    ];

    /**
     * Summary of bookRent
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<BookRent, Member>
     */
    public function bookRent() {
        return $this->hasMany(BookRent::class, 'member_id', 'id');
    }
}
