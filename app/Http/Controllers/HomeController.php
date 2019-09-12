<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function login()
    {
        //get email and pass from request
        $credentials = request(['email', 'password']);

        //try to auth and get the token using api authentication
        if (!$token = auth('api')->attempt($credentials)) {

            // if the credentials  are wrong  send an unauthorized error in json format
            // return response()->json(['error' => 'Unauthorized'], 401);
            return response()->json(['data' => $credentials], 401);
        }

        return  response()->json([
            'token' => $token,
            'type' => 'bearer',  //you can ommit this
            'expires' => auth('api')->factory()->getTTL() * 60, //time to expiration 
        ]);
    }
}
