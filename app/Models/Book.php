<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $table = 'books';
    protected $fillable = ['name', 'book_category_id', 'thumbnail', 'description', 'author'];

    public function category()
    {
        return $this->belongsTo(Book_Category::class, 'book_category_id');
    }
}
