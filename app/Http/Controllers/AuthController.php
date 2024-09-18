<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(){
        return view ('login');
    }

    public function logout(){
        echo 'logout';
    }
}
