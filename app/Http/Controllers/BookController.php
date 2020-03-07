<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Book;

class BookController extends Controller
{
    public function showBooks()
    {
        $bookGot = Book::all();
        return response($bookGot, 200);
    }

    public function createBook(Request $request)
    {
        try {
            $book = new Book;
            $book->title = $request->title;
            $book->description = $request->description;
            $book->save();
            return response()->json([
                "message" => "Book Created Succesfully"
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => "Not Possible To Create Book"
            ], 200);
        }
    }
}
