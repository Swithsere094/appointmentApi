<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\IdType;
use App\Models\User;
use Illuminate\Http\Request;
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
        Logger($request);

        User::create([
            'id_types_id' => $request->docType,
            'document' => $request->document,
            'name' => $request->name,
            'email' => $request->email,
            'roles_id' => $request->docType == 1 ? 2 : 1,
            'password' => Hash::make($request->password),
        ]);
    }

    public function getIdTypes()
    {
        return IdType::get(['id', 'description']);
    }
}
