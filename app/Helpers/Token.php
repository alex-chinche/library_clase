<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use \Firebase\JWT\JWT;
use App\User;

class Token
{

    private  $key = 'y!JFj&?5J-+uZEYn_5?zxHaKXM?c%3eshxsAE2%Na@2x%c+8wZM^^vP6gGY@*5kNtsSRXDpCv2qURtA3n-?t+2YrDxMCDFaY^QnAns9@kb3-mQ4!@&SWj7_z$eqf9rpMej9XAh6#fBLrfHdACLLN6$Srp+bJqMPKD3wtGk77=vmM=v66=ar%cXB548nJ?U!FhLFe!RDxEAWwPm=$HdkaHMg@v+d@eaRrzK5G%?94=-G6?mQcWR7qC9hP?MKhrGTB';

    public function set_token($request)
    {
        $data_token = [
            "encrypted_email" => $request->email,
        ];
        $data = JWT::encode($data_token, $this->key);
        return $data;
    }
    public function decode_token($token)
    {
        return JWT::decode($token, $this->key, array('HS256'));
    }
}
