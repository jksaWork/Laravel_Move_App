<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{
    public function login(Request $request){
        $rules = ['email' => 'required', 'password' => 'required'];
        $validator =  validator($request->all(), $rules);
        if($validator->fails()) return response()->ApiErrors($validator->errors());
        // Check  This Is Right Credinales
        if(Auth::attempt($validator->validated())){
            $data['user'] = new UserResource(Auth::user());
            $data['token'] = Auth::user()->createToken('jska')->plainTextToken;
            return response()->ApiSuccess($data);
        }
        // return Error Response
        response()->ApiErrors($validator->errors("Invalid Credintail"));
    }

    public function register(Request $request){
        $rules = ['email' => 'required', 'password' => 'required', 'name' => 'required'];
        $validator =  validator($request->all(), $rules);
        if($validator->fails()) return response()->ApiErrors($validator->errors());
        $user = User::create($validator->validated());
        $data['token'] = $user->createToken('jska')->plainTextToken;
        $data['user'] = new UserResource($user); #->createToken('jska')->plainTextToken;
        return response()->ApiSuccess($data);
    }
}
