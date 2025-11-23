<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Transaction;
use App\Models\Book;

class TransactionDetail extends Model
{
    protected $fillable = [
        'transaction_id',
        'book_id',
        'qty',
        'price',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    } 
}
