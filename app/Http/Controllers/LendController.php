<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Helpers\Token;
use App\Book;
use App\Lend;

class LendController extends Controller
{
    public function lendBook(Request $request)
    {
        $user = new User;
        $userController = new UserController;
        $user = $userController->getUserFromToken($request);

        try {
            $book = new Book;
            $book = Book::where("title", $request->title)->first();
            $selected_id = $book->id;
        } catch (\Throwable $th) {
            return response()->json([
                "message" => "Book Selected Is Not In Database"
            ], 200);
        }
        try {
            $lend = new Lend;
            $lend->user_id = $user->id;
            $lend->book_id = $selected_id;
            $lend->save();
            return response()->json([
                "message" => "Lend Completed"
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => "Not PossibleTo Complete The Lend"
            ], 200);
        }
    }
}
