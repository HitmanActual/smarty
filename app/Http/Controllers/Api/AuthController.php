<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ResponseTrait;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    use ResponseTrait;
    public function register(Request $request){
        $validateData = $request->validate([
            'name'=>'required|max:55',
            'email'=>'required|email',
            'password'=>'required|confirmed',
            'school_id'=>'required',
        ]);


        $validateData['password'] = bcrypt($request->password);
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
            return response(['user' => auth()->user(), 'access_token' => $accessToken]);
        } else {
            return 'your Email is not Verified';
        }


    }


}
