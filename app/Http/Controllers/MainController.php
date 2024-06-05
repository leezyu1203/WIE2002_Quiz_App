<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use Illuminate\Support\Facades\Log;

class MainController extends Controller
{
    function index() {
        $data = Note::orderBy('created_at', 'desc')->get();
        return view('home', ['data'=>$data]);
    }

    function add_note(Request $request) {
        $request -> validate([
            'heading' => 'required',
            'note' => 'required',
        ]);

        $note = new Note;
        $note -> heading = $request -> heading;
        $note -> note = $request -> note;
        $save = $note -> save();

        if($save) {
            return back();
        } else {
            return back() -> with('fail', 'Something went wrong, try again later.');
        }
    }

    function edit(Request $request, String $id) {
        $request -> validate([
            'heading' => 'required',
            'note' => 'required',
        ]);

        $note = Note::findOrFail($id);
        $note -> heading = $request -> heading;
        $note -> note = $request -> note;

        $update = $note ->save();

        if($update) {
            return back();
        } else {
            return back() -> with('fail', 'Something went wrong, try again later.');
        }
    }

    function delete(String $id) {
        Note::where('id', $id)->delete();
        return back();
    }

    function search(Request $request) {
        $query = $request->search;

        $results = Note::whereRaw('heading REGEXP ?', [$query])->get();

        return back() -> with('results', $results);
    }
}
