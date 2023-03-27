<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password //set in model
        ]);

        return response()->json(['user' => $user], 200);
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();
        if(!$user) {
            return response(['error_message' => 'Incorrect Details.
            Please try again']);
        }

        $password = $user->validateForPassportPasswordGrant($request->password);


        if ($password == 422) {
            return response('Bad Request', 422);
        }

        $user['token'] = $user->createToken('passport_token')->accessToken;

        // return response(['user' => auth()->user()]);

        return $user;

    }
}
