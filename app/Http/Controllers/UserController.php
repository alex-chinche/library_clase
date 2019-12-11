<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Helpers\Token;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
        $token1 = new Token();
        $token2 = $token1->set_token($user->email);

        return response()->json([
            'token' => $token2
        ], 200);
    }

    public function login(Request $request)
    {
        $data = ['email' => $request->email];
        $user = User::where('email', $request->email)->first();
        
        try {
                if ($user->password == $request->password) {
                    $token = new Token($data);
                    $encoded_token = $token->set_token($user->email);
                    return response()->json([
                        'token' => $encoded_token
                    ], 200);
                } else {
                    return response()->json([
                        'message' => "incorrect password"
                    ], 401);
                }
        } catch (\Throwable $th) {
            return response()->json([
                'message' => "incorrect email"
            ], 401);
        } 
    }

    public function lend(Request $request)
    {
            try {
                $token1 = new Token();
                $token_decoded = $token1->decode_token($request->header('Authorization'));
                $mail = $token_decoded;
                $user = User::where('email', $mail)->first();
                $user->books()->attach($request->book_id);
                return response()->json([
                    "message" => "book lend correctly"
        ], 200);
                } catch (\Throwable $th) {
                return response()->json([
                    'message' => "book not found"
                ], 401);
            } 
    }
}
