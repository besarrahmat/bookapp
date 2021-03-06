<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

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
        try {
            $book = Book::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'book not found'
            ], 404);
        }

        $id_book = Book::find($id);
        
        return response([
            'message' => 'show book by id',
            'data' => $id_book
        ], 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'author' => 'required'
        ]);

        $book = Book::create(
            $request->only(['title', 'description', 'author'])
        );

        return response()->json([
            'created' => true,
            'data' => $book
        ], 201);
    }

    public function update(Request $request, $id)
    {
        try {
            $book = Book::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'book not found'
            ], 404);
        }
        
        $book->fill(
            $request->only(['title', 'description', 'author'])
        );
        
        return response()->json([
            'updated' => true,
            'data' => $book
        ], 200);
    }
    
    public function destroy($id)
    {
        try {
            $book = Book::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'book not found'
            ], 404);
        }
        
        $book->delete();
        
        return response()->json([
            'deleted' => true
        ], 200);
    }
}