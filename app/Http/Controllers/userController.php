<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class userController extends Controller
{
    public function getBusinessList(Request $request)
    {
        $businessList = (new User)->getBusinessList($request);
        return $businessList;
    }
}
