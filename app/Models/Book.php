<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'description',
        'isbn',
        'quantity'
    ];

    /**
     * The users that belong to the book.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'book_user');
    }
}
