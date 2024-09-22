<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(){

        // leitura das notas dos utilizadores

        return view('home');
    }
    public function newNote(){
        echo 'Notas ';
    }
}
