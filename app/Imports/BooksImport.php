<?php

namespace App\Imports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\ToModel;

class BooksImport implements ToModel
{
    public function model(array $row)
    {
        return new Book([
            'name' => $row[0],
            'author' => $row[1],
            'description' => $row[2],
            'book_category_id' => $row[3],
        ]);
    }
}

