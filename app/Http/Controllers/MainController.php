<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Operations;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use PhpParser\Node\Stmt\TryCatch;

class MainController extends Controller
{
    public function index()
    {
        $id = session('user.id');
        // leitura das notas dos utilizadores

        $notes = User::find($id)->notes()->get()->toArray();


        return view('home', ['notes' => $notes]);
    }
    public function newNote(){
        return view('new_note');
    }
    public function newNoteSubmit(Request $request){
        echo 'submit';
    }

    public function editNote($id)
    {
        $id = Operations::decryptId($id);

        echo "edit $id";


    }

    public function deleteNote($id)
    {
        $id = Operations::decryptId($id);

        echo "delete $id";

    }


}
