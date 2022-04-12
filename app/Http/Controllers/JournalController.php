<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JournalController extends Controller
{
    public function journals(){
        return response()->json(Journal::get(), 200);
    }

    public function journalById($id){
        $journal = Journal::find($id);
        if( is_null($journal))
        {
            return response()->json(['error'=>true, 'message'=>'Not found'], 404);
        }
        return response()->json($journal, 200);
    }

    public function journalAdd(Request $request){
        $rules = ['content'=>'required|min:10'];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $journal = Journal::create($request->all());
        return response()->json($journal, 201);

    }

    public function journalEdit(Request $request ,$id){
        $journal = Journal::find($id);
        if( is_null($journal))
        {
            return response()->json(['error'=>true, 'message'=>'Not found'], 404);
        }
        $rules = ['content'=>'required|min:10'];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $journal->update($request->all());
        return response()->json($journal, 200);
    }

    public function journalDelete($id){
        $journal = Journal::find($id);
        if( is_null($journal))
        {
            return response()->json(['error'=>true, 'message'=>'Not found'], 404);
        }
        $journal->delete();
        return response()->json('Deleted', 204);
    }
}
