<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    //

    public function index()
    {
        return view('register');
    }

    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name'     => 'required|string|between:2,100',
                'email'    => 'required|string|email|max:100|unique:users',
                'password' => 'required|string|confirmed|min:6',
            ]
        );

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400
            );
        }

        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));

        return response()->json(['message' => 'User created successfully', 'user' => $user]);

    }//end register()
}
