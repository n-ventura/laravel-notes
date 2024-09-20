<?php

namespace App\Http\Controllers;

use App\Models\User;
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
            //Rules
            [
                'text_username' => 'required|email',
                'text_password' => 'required|min:6|max:16'
            ],
            //error messages
            [
                'text_username.required' => "O username é obrigatório",
                'text_username.email' => "Username deve ser um email válido",
                'text_password.required' => "A password é obrigatória",
                'text_password.min' => 'A password deve ter pelo menos :min caracteres',
                'text_password.max' => 'A password deve ter no máximo :max caracteres'
            ]
        );

        $username = $request->input('text_username');
        $password = $request->input('text_password');

        //get all tuhe users from the database

        $users = User::all()->toArray();

        echo '<pre>';

        print_r($users);
    }

    public function logout()
    {
        echo 'logout';
    }
}
