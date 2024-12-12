<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Book_Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $books = Book::count();
        $categories =Book_Category::count();
        return view('home', compact('books', 'categories'));
    }
}
