<?php

namespace App\Http\Controllers;

/*
  updated on : 9th July,2020
  updated by: Deepa Prasanna
  description : Controller having two functions login and logout
 */


use Illuminate\Http\Request;
use  App\User;
use Illuminate\Support\Facades\Hash;

class ApiLoginController extends Controller
{
    //
    public function login(Request $request)
    {
        /* =>retrieving the user's email field from the request
           =>if no user found with the requested email, then the response is "user doesn't exist"
           =>else,if the retrieved user's encrypted password matches the password from the request,
             generate a token and send it as a response with 200 status code,
           =>else return response as "password mismatch"

      */

        $user = User::where('email', $request->email)->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('Laravel password grant client')->accessToken;
                $response = ['token' => $token];
                return response($response, 200);
            }
            //  else {
            //     $response = 'password mismatch';
            //     return response($response, 422);
            // }

            else {
                // $response = 'User doesnt\'t exist';
                $response = "username/password incorrect";
                return response($response, 422);
            }
        } else {
            // $response = 'User doesnt\'t exist';
            $response = "username/password incorrect";
            return response($response, 422);
        }
    }


    public function logout(Request $request)
    {
        /*
          =>Grab the user from the request
          =>Grab the current token from user
          =>Revoke the token taken from the user and return the response with 200 status code
        */
       
        $request->user()->token()->revoke();
       
      
        $response = 'You have been successfully logged out!';
        return response($response, 200);
    }
}
