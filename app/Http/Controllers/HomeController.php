<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\IdType;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function userRegister(Request $request)
    {
        $validate = $this->validate($request, [
            'docType' => 'required',
            'document' => 'required | min: 8 | max: 10',
            'name' => 'required | min: 6 | max: 20',
            'lastName' => 'required | min: 6 | max: 20',
            'email' => 'required | email',
            'password' => 'required | confirmed | min: 6',
        ]);

        return $validate;
    }

    public function getIdTypes()
    {
        return IdType::get(['id', 'description']);
    }
}
