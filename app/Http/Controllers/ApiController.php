<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;


class ApiController extends Controller
{
    //
    public function getAllUsers() {
        // logic to get all users goes here
        $user = User::get()->toJson(JSON_PRETTY_PRINT);
        return response($user, 200);


      }

      public function createUser(Request $request) {
        //validate the request data
        $this->validate($request, [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);



        // logic to create a user record goes here
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->user_type = $request->user_type;
        $user->password = bcrypt($request->password);
        $user->user_status = $request->user_status;
        $user->save();
        $token = $user->createToken('userCreateToken')->accessToken;
        return response()->json([
            'token' => $token,
            "message" => "user record created"
            // 'token'=>$token
        ], 201);


      }

      public function getUser($id) {
        // logic to get a user record goes here
        if (User::where('id', $id)->exists()) {
            $user = User::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($user, 200);
          } else {
            return response()->json([
              "message" => "User not found"
            ], 404);
          }

      }

      public function updateUser(Request $request, $id) {
        // logic to update a user record goes here
        if (User::where('id', $id)->exists()) {
            $user = User::find($id);
            $user->name = is_null($request->name) ? $user->name : $request->name;
            $user->email = is_null($request->email) ? $user->email : $request->email;
            $user->user_type = is_null($request->user_type) ? $user->user_type : $request->user_type;
            $user->password = is_null($request->password) ? $user->password : $request->password;
            $user->user_status = is_null($request->user_status) ? $user->user_status : $request->user_status;

            $user->save();

            return response()->json([
                "message" => "records updated successfully"
            ], 200);
            } else {
            return response()->json([
                "message" => "User not found"
            ], 404);

        }

      }

      public function deleteUser ($id) {
        // logic to delete a user record goes here
        if(User::where('id', $id)->exists()) {
            $user = User::find($id);
            $user->delete();

            return response()->json([
              "message" => "user record deleted"
            ], 202);
          } else {
            return response()->json([
              "message" => "User not found"
            ], 404);
          }

      }
}
