<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\IdType;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessTokenFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Monolog\Logger;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function userRegister(UserRequest $request)
    {
        User::create([
            'id_types_id' => $request->docType,
            'document' => $request->document,
            'name' => $request->name,
            'email' => $request->email,
            'roles_id' => $request->docType == 1 ? 2 : 1,
            'password' => Hash::make($request->password),
        ]);
    }

    public function userLogin(Request $request)
    {
        $credentials = $request->only('document', 'password');
        $remember = $request->only('rememberMe')['rememberMe'];

        if (Auth::attempt($credentials, $remember)) {
            /** @var \App\Models\User $user **/
            $user = Auth::user();
            $token = $user->createToken('TokenName')->plainTextToken;
            return response()->json(['token' => $token], 200);
        } else {
            throw new AuthorizationException('Incorrect Credentials');
        }
    }

    public function getIdTypes()
    {
        return IdType::get(['id', 'description']);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return response()->json(['message' => 'Successfully logged out'], 200);
    }
}
