<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserAuthController extends Controller
{
    public function register(Request $request)
    {
        try 
        {
            $data = $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|email|unique:users',
                'password' => 'required|confirmed'
            ]);

            $data['password'] = bcrypt($request->password);

            $user = User::create($data);

            $token = $user->createToken('API Token')->accessToken;

            return response()->json([
                'status'    => true,
                'result'    => [ 'user' => $user, 'token' => $token]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'    => FALSE,
                'result'    => ['message'=> $e->getMessage()] ]);
        }
    }

    public function login(Request $request)
    {
        try
        {
            $data = $request->validate([
                'email' => 'email|required',
                'password' => 'required'
            ]);

            if (!auth()->attempt($data)) {
                return response()->json([
                    'status'    => false,
                    'result'    => ['message'=> 'Incorrect Details !']
                ]);
            }

            $token = auth()->user()->createToken('API Token')->accessToken;
            return response()->json([
                'status'    => true,
                'result'    => ['user' => auth()->user(), 'token' => $token]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'    => FALSE,
                'result'    => ['message'=> $e->getMessage()] ]);
        }

    }
}
