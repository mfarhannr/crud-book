<?php

use App\Http\Controllers\BookCategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

use App\Exports\BooksExport;
use App\Imports\BooksImport;
use Maatwebsite\Excel\Facades\Excel;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::resource('book', BookController::class);
Route::resource('category', BookCategoryController::class);

Route::get('/books/export', function () {
    return Excel::download(new BooksExport, 'books.xlsx');
})->name('books.export');

Route::post('/books/import', function (\Illuminate\Http\Request $request) {
    $request->validate(['file' => 'required|mimes:xlsx,xls']);
    Excel::import(new BooksImport, $request->file('file'));
    return redirect()->route('books.index')->with('success', 'Books imported successfully.');
})->name('books.import');

