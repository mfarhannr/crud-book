<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Book_Category;
use File;
use App\Imports\BooksImport;
use App\Exports\BooksExport;
use Maatwebsite\Excel\Facades\Excel;


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
            'thumbnail'        => 'nullable|image|mimes:jpg,png,jpeg',
            'description' => 'required',
            'author' => 'required',
        ]);

        $thumbnailName = null;

        // Proses upload thumbnail jika ada
        if ($request->hasFile('thumbnail')) {
            $thumbnailName = time() . '.' . $request->thumbnail->extension();
            $request->thumbnail->move(public_path('img/thumbnail'), $thumbnailName);
        }

        $book = new Book;

        $book->book_category_id = $request->book_category_id;
        $book->name       = $request->name;
        $book->thumbnail = $thumbnailName ?: $book->thumbnail;
        $book->description        = $request->description;
        $book->author        = $request->author;

        $book->save();

        return redirect()->route('book.index')->with('success', 'Book created successfully.');
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
            'thumbnail'        => 'image|mimes:jpg,png,jpeg',
            'description' => 'required',
            'author' => 'required',
        ]);

        if ($request->has('thumbnail')) {
            $book = book::find($id);

            $path = "img/thumbnail/";
            File::delete($path . $book->thumbnail);

            $thumbnailName = time() . '.' . $request->thumbnail->extension();

            $request->thumbnail->move(public_path('img/thumbnail'), $thumbnailName);

            $book->book_category_id = $request->book_category_id;
            $book->name       = $request->name;
            $book->thumbnail = $thumbnailName ?: $book->thumbnail;
            $book->description        = $request->description;
            $book->author        = $request->author;

            $book->save();

            return redirect('/book');
        } else {
            $book = book::find($id);

            $book->book_category_id = $request->kategori_id;
            $book->name       = $request->name;
            $book->description        = $request->description;
            $book->author        = $request->author;

            $book->save();

            return redirect()->route('book.index')->with('success', 'Book updated successfully.');
        }
    }

    public function destroy($id)
    {
        $book = book::find($id);

        $path = "img/thumbnail/";
        File::delete($path . $book->thumbnail);
        $book->delete();

        return redirect()->route('book.index')->with('success', 'Book deleted successfully.');
    }

    public function export()
    {
        return Excel::download(new BooksExport, 'books.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate(['file' => 'required|mimes:xlsx,xls']);
        Excel::import(new BooksImport, $request->file('file'));
        return redirect()->route('book.index')->with('success', 'Books imported successfully.');
    }
}
