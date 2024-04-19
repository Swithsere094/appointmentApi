<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PasswordReset;
use Illuminate\Http\Request;

class CodeCheckController extends Controller
{
    public function __invoke(Request $request)
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
}
