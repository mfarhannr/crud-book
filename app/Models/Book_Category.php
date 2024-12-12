<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book_Category extends Model
{
    use HasFactory;
    protected $table = 'book_categories';
    protected $fillable = ['name'];

    public function books()
    {
        return $this->hasMany(Book::class, 'book_category_id');
    }
}
