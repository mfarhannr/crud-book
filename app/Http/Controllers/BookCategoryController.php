<?php

namespace App\Http\Controllers;
use App\Models\Book_Category;

use Illuminate\Http\Request;

class BookCategoryController extends Controller
{
    public function index()
    {
        $categories = Book_Category::all();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:book_categories',
        ]);

        Book_Category::create($request->all());

        return redirect()->route('category.index')->with('success', 'Category created successfully.');
    }

    public function edit(Book_Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Book_Category $category)
    {
        $request->validate([
            'name' => 'required|unique:book_categories,name,' . $category->id,
        ]);

        $category->update($request->all());

        return redirect()->route('category.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Book_Category $category)
    {
        $category->delete();

        return redirect()->route('category.index')->with('success', 'Category deleted successfully.');
    }
}
