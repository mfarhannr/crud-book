<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Book_Category;
use File;

use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('category')->get();
        return view('books.index', compact('books'));
    }

    public function create()
    {
        $categories = Book_Category::all();
        return view('books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:books',
            'book_category_id' => 'required',
            'description' => 'required',
            'author' => 'required',
        ]);

        $thumbnail = time() . '.' . $request->thumbnail->extension();

        $request->thumbnail->move(public_path('img/thumbnail'), $thumbnail);

        $book = new Book;

        $book->book_category_id = $request->kategori_id;
        $book->name       = $request->judul;
        $book->thumbnail     = $thumbnail;
        $book->description        = $request->description;

        $book->save();

        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }

    public function edit($id)
    {
        $categories = Book_Category::all();
        $book   = Book::findOrFail($id);
        return view('books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:books,name,',
            'book_category_id' => 'required',
            'description' => 'required',
            'author' => 'required',
        ]);

        if ($request->has('thumbnail')) {
            $book = book::find($id);

            $path = "img/thumbnail/";
            File::delete($path . $book->thumbnail);

            $thumbnail = time() . '.' . $request->thumbnail->extension();

            $request->thumbnail->move(public_path('img/thumbnail'), $thumbnail);

            $book->book_category_id = $request->kategori_id;
            $book->name       = $request->judul;
            $book->thumbnail     = $thumbnail;
            $book->description        = $request->description;

            $book->save();

            return redirect('/book');
        } else {
            $book = book::find($id);

            $book->book_category_id = $request->kategori_id;
            $book->name       = $request->judul;
            $book->description        = $request->description;

            $book->save();

            return redirect()->route('books.index')->with('success', 'Book updated successfully.');
        }
    }

    public function destroy($id)
    {
        $book = book::find($id);

        $path = "img/thumbnail/";
        File::delete($path . $book->thumbnail);
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }
}
