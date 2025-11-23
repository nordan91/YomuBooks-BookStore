<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Book;
use App\Models\User;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'book_id',
        'book_image',
        'price',
        'qty',
        'weight',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
