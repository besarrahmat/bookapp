<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class AuthorController extends Controller
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
        return Author::all();
    }

    public function getAuthor($id)
    {
        try {
            $author = Author::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'author not found'
            ], 404);
        }

        $id_author = Author::find($id);
        
        return response([
            'message' => 'show author by id',
            'data' => $id_author
        ], 200);
    }

    public function postAuthor(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'gender' => 'required',
            'biography' => 'required'
        ]);

        $author = Author::create(
            $request->only(['name', 'gender', 'biography'])
        );

        return response()->json([
            'created' => true,
            'data' => $author
        ], 201);
    }

    public function putAuthor(Request $request, $id)
    {
        try {
            $author = Author::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'author not found'
            ], 404);
        }
        
        $author->fill(
            $request->only(['name', 'gender', 'biography'])
        );
        
        return response()->json([
            'updated' => true,
            'data' => $author
        ], 200);
    }
    
    public function deleteAuthor($id)
    {
        try {
            $author = Author::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'author not found'
            ], 404);
        }
        
        $author->delete();
        
        return response()->json([
            'deleted' => true
        ], 200);
    }
}