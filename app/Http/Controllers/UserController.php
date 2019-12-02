<?php

namespace App\Http\Controllers;

use \Firebase\JWT\JWT;
use Illuminate\Http\Request;
use App\User;
use App\Book;
use App\Helpers\Token;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();

        $token1 = new Token();
        $token1->set_token($request);
    }

    public function login(Request $request)
    {
        $data = ['email' => $request->email];
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if ($user->password == $request->password) {
                $token = new Token($data);
                $encoded_token = $token->set_token($request);
                return response()->json([
                    'token' => $encoded_token
                ], 200);
            } else {
                return response()->json([
                    'message' => "incorrect password"
                ], 401);
            }
        } else {
            return response()->json([
                'message' => "incorrect email"
            ], 401);
        }
    }

    public function lend(Request $request)
    {
        $token1 = new Token();
        $token_decoded = $token1->decode_token($request->token);
        $mail = $token_decoded->encrypted_email;
        $user = User::where('email', $mail)->first();
        $user->books()->attach($request->book_id);
        return response()->json([
            "message" => "book lend correctly"
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
