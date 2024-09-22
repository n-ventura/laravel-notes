<?php

namespace App\Http\Controllers;

use App\Models\Note;
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

        $notes = User::find($id)
                        ->notes()
                        ->whereNull('deleted_at')
                        ->get()->toArray();


        return view('home', ['notes' => $notes]);
    }
    public function newNote(){
        return view('new_note');
    }
    public function newNoteSubmit(Request $request){
        // validação
        $request->validate(
            //Rules
            [
                'text_title' => 'required|min:3|max:200',
                'text_note' => 'required|min:3|max:3000'
            ],
            //error messages
            [
                'text_title.required' => "O título é obrigatório",
                'text_title.min' => 'O título deve ter pelo menos :min caracteres',
                'text_title.max' => 'O título deve ter no máximo :max caracteres',

                'text_note.required' => "A nota é obrigatória",
                'text_note.min' => 'A nota deve ter pelo menos :min caracteres',
                'text_note.max' => 'A nota deve ter no máximo :max caracteres'
            ]
        );
        //get user id

        $id = session('user.id');

        //criação da nota
        $note = new Note();
        $note->user_id = $id;
        $note->title = $request->text_title;
        $note->text = $request->text_note;

        $note->save();


        //redirect to home

        return redirect()->route('home');
    }

    public function editNoteSubmit(Request $request)
    {
        // validação do form

        $request->validate(
            //Rules
            [
                'text_title' => 'required|min:3|max:200',
                'text_note' => 'required|min:3|max:3000'
            ],
            //error messages
            [
                'text_title.required' => "O título é obrigatório",
                'text_title.min' => 'O título deve ter pelo menos :min caracteres',
                'text_title.max' => 'O título deve ter no máximo :max caracteres',

                'text_note.required' => "A nota é obrigatória",
                'text_note.min' => 'A nota deve ter pelo menos :min caracteres',
                'text_note.max' => 'A nota deve ter no máximo :max caracteres'
            ]
        );

        //id da nota existe ?
        if($request->note_id == null)
        {
            return redirect()->route('home');

        }

        $id = Operations::decryptId($request->note_id);
        //leitura da nota

        $note = Note::find($id);

        //update na nota
        $note->title = $request->text_title;
        $note->text = $request->text_note;

        $note->save();

        //redirect to home

        return redirect()->route('home');
    }

    public function editNote($id)
    {
        $id = Operations::decryptId($id);

        echo "note id $id";
        //carregar os dados da nota para edição
        $note = Note::find($id);

        return view('edit_note', ['note' =>$note]);

    }

    public function deleteNote($id)
    {
        $id = Operations::decryptId($id);

        //leitura da nota
        $note = Note::find($id);

        return view('delete_note', ['note' => $note]);

    }

    public function deleteNoteConfirm($id)
    {
        //validar o id encriptado
        $id = Operations::decryptId($id);
        //ler a nota
        $note = Note::find($id);

        //hard delete
        //$note->delete(); // remover fisicamente o registo da base de dados

        //soft delete
        //apenas actualiza o campo deleted_at
        //$note->deleted_at = date('Y-m-d H:i:s');
        //$note->save();

        // model use softDeletes
        $note->delete();

        //redirecionar

        return redirect()->route('home');
    }


}
