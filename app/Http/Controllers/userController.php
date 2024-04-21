<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class userController extends Controller
{
    public function getBusinessList(Request $request)
    {
        $businessList = User::where('roles_id', 1)->get();
        return $businessList;
    }
}
