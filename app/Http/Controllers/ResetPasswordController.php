<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'token' => 'required|string|exists:reset_code_passwords',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // find the code
        $passwordReset = PasswordReset::firstWhere('token', $request->token);

        // check if it does not expired: the time is one hour
        if ($passwordReset->created_at > now()->addHour()) {
            $passwordReset->delete();
            return response(['message' => 'Password code is expired'], 422);
        }

        // find user's email
        $user = User::firstWhere('email', $passwordReset->email);

        $hashedPassword = array('password' => Hash::make($request->only('password')['password']));
        // update user password
        $user->update($hashedPassword);

        // delete current code
        $passwordReset->delete();

        return response(['message' => 'password has been successfully reset'], 200);
    }
}
