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
}
