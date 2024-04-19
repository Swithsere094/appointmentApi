<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\SendCodeResetPassword;
use App\Models\PasswordReset;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    public function __invoke(Request $request)
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
}
