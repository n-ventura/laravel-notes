<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(){
        echo 'home';
    }
    public function newNote(){
        echo 'Notas ';
    }
}
