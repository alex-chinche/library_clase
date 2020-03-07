<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Helpers\Token;

class UserController extends Controller
{
    public function createUser(Request $request)
    {
        try {
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
        } catch (\Throwable $th) {
            return response()->json([
                'message' => "Not possible to create user"
            ], 401);
        }
    }

    public function loginUser(Request $request)
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
                    'message' => "Incorrect password"
                ], 401);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'message' => "Incorrect email"
            ], 401);
        }
    }

    public function getUserFromToken(Request $request)
    {
        $tokenSummon = new Token;
        $codedToken = $request->header("token");
        $emailFromToken = $tokenSummon->decode_token($codedToken);
        $user = User::where("email", $emailFromToken)->first();

        return $user;
    }
}
