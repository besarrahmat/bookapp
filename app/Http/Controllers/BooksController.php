<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Support\Facades\DB;

class BooksController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
        return Book::all();
    }

    public function getBook($id)
    {
        $id_book = Book::find($id);
        if (!$id_book) {
            return response("Book Not Found", 404);
        }
        return response(json_encode($id_book), 200);
    }
}
