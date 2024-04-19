<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\SendCodeResetPassword;
use App\Models\PasswordReset;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    public function forgotPassword(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|exists:users',
        ]);
        $passwordReset = PasswordReset::where('email', $request->email)->first();

        if ($passwordReset) {
            $passwordReset->delete();
        }

        $data['token'] = mt_rand(100000, 999999);

        $codeData = PasswordReset::create($data);

        Mail::to($request->email)->send(new SendCodeResetPassword($codeData->token));

        return response(['message' => 'Password Reset Code Sent', 'status' => 200], 200);
        try {
        } catch (Exception $e) {
            throw new Exception('Verification email failed');
        }
    }

    public function codeCheck(Request $request)
    {
        $request->validate([
            'token' => 'required|string|exists:reset_code_passwords',
        ]);

        $passwordReset = PasswordReset::firstWhere('token', $request->token);

        // check if it does not expired: the time is one hour
        if ($passwordReset) {
            if ($passwordReset->created_at > now()->addHour()) {
                $passwordReset->delete();
                return response(['message' => 'Password code is expired'], 422);
            }
        }

        return response([
            'token' => $passwordReset->token,
            'message' => 'Password code is ' . $passwordReset->token ? 'valid' : 'invalid'
        ], $passwordReset->token ? 200 : 500);
    }

    public function resetPassword(Request $request)
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
