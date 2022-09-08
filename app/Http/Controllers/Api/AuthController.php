<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function register(Request $request){
        $validateData = $request->validate([
            'name'=>'required|max:55',
            'email'=>'required|email',
            'password'=>'required|confirmed',
        ]);

        $user = User::create($validateData);
        $accessToken = $user->createToken('authToken')->accessToken;

        return response(['user' => $user, 'access_token' => $accessToken]);
    }


    public function login(Request $request)
    {

        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required',
        ]);


        if (!auth()->attempt($loginData)) {
            return $this->errorResponse('invalid credentials', Response::HTTP_UNAUTHORIZED);
        }

        if (auth()->user()->email_verified_at != null) {
            $accessToken = auth()->user()->createToken('authToken')->accessToken;
            return response(['user' => auth()->user(), 'roles' => auth()->user()->roles,'team_members'=>auth()->user()->children,'team_leader'=>auth()->user()->_parent,'access_token' => $accessToken]);
        } else {
            return 'your Email is not Verified';
        }


    }


}
