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
        $message_success = array('message' => "show book by id",'data' => json_decode($id_book));
        $message_error = array('message' => "book not found");
        if (!$id_book) {
            return response(json_encode($message_error), 404);
        }
        return response(json_encode($message_success), 200);
    }
}
