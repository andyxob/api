<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JournalController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/journal/",
     *     @OA\Response(response="200", description="Display a listing of journals.")
     * )
     */

    public function journals(){
        return response()->json(Journal::get(), 200);
    }

    /**
     * @OA\Get(
     *     path="/api/journal/{id}",
     *     @OA\Response(response="200", description="Display journal by id.")
     * )
     */
    public function journalById($id){
        $journal = Journal::find($id);
        if( is_null($journal))
        {
            return response()->json(['error'=>true, 'message'=>'Not found'], 404);
        }
        return response()->json($journal, 200);
    }

    /**
     * @OA\Post (
     *     path="/api/journal/add",
     *     @OA\Response(response="201", description="Add journal.")
     * )
     */

    public function journalAdd(Request $request){
        $rules = ['content'=>'required|min:10'];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $journal = Journal::create($request->all());
        return response()->json($journal, 201);

    }

    /**
     * @OA\Put(
     *     path="/api/journal/{id}",
     *     @OA\Response(response="200", description="Edit journal.")
     * )
     */

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

    /**
     * @OA\Delete (
     *     path="/api/journal/{id}",
     *     @OA\Response(response="204", description="Delete journal.")
     * )
     */

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
