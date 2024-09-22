<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        echo 'Notas ';
    }

    public function editNote($id)
    {
        $id = $this->decryptId($id);

        echo "edit $id";


    }

    public function deleteNote($id)
    {
        $id = $this->decryptId($id);

        echo "delete $id";

    }

    private function decryptId($id)
    {
        try {
            $id = Crypt::decrypt($id);
        }catch(DecryptException $e) {
            return redirect()->route('home');
        }

        return $id;
    }
}
