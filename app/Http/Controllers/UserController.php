<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Response;
use Validator;

class UserController extends Controller
{
    //
        /**
     * Handles Registration Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
        
        
        if(User::where('email','=',$request->email)->count()>0)
        {
            return response::json(['exist'=>'yes']);
        }

        if($validator->fails()){
            return response::json($validator->errors()); 
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'profile_img' => 'profile_img1.jpg',
            'password' => bcrypt($request->password)
        ]);
        //$user = User::where(1);
        $token = $user->createToken('ObaidWeb')->accessToken;
 
        return response::json(['token' => $token], 200);
    }
 
    /**
     * Handles Login Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
 
        if (auth()->attempt($credentials)) {
            $token = auth()->user()->createToken('ObaidWeb')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response::json(['error' => 'UnAuthorised'], 401);
        }
    }

    public function checkEmailExist( String $email)
    {
        if(User::where('email','=',$email)->count()>0)
        {
            return response::json(['exist'=>'yes']);
        }
        else
        return response::json(['exist'=>'no']);
    }
 
    /**
     * Returns Authenticated User Details
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function details()
    {
        return response::json(['user' => auth()->user()], 200);
    }
}
