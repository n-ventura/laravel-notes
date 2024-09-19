<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view ('login');
    }

    public function loginSubmit(Request $request)
    {
        //Validation errors
        $request->validate(
            [
                'text_username' => 'required',
                'text_password' => 'required'
            ]
        );

        $username = $request->input('text_username');
        $password = $request->input('text_password');

        echo 'ok!';
    }

    public function logout()
    {
        echo 'logout';
    }
}
