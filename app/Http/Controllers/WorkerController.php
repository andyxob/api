<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WorkerController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/worker/",
     *     @OA\Response(response="200", description="Display a listing of workers.")
     * )
     */
    public function workers(){
        return response()->json(Worker::get(), 200);
    }

    /**
     * @OA\Get(
     *     path="/api/worker/{id}",
     *     @OA\Response(response="200", description="Display worker by id.")
     * )
     */

    public function workerById($id){
         $worker = Worker::find($id);
         if( is_null($worker))
         {
            return response()->json(['error'=>true, 'message'=>'Not found'], 404);
         }
         return response()->json($worker, 200);

    }

    /**
     * @OA\Post (
     *     path="/api/worker/add",
     *     @OA\Response(response="201", description="Add worker.")
     * )
     */

    public function workerAdd(Request $request){
        $rules = ['shop'=>'required',
            'journal'=>'required',
            'name'=>'required|min:4|max:25',
            'surname'=>'required|min:4|max:25'];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $worker = Worker::create($request->all());
        return response()->json($worker, 201);
    }

    /**
     * @OA\Put(
     *     path="/api/worker/{id}",
     *     @OA\Response(response="200", description="Edit worker.")
     * )
     */

    public function workerEdit(Request $request, $id){
        $worker = Worker::find($id);
        if( is_null($worker))
        {
            return response()->json(['error'=>true, 'message'=>'Not found'], 404);
        }
        $rules = ['shop'=>'required',
            'department'=>'required',
            'name'=>'required|min:4|max:25',
            'surname'=>'required|min:4|max:25'];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $worker->update($request->all());
        return response()->json($worker, 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/worker/{id}",
     *     @OA\Response(response="204", description="Delete worker.")
     * )
     */

    public function workerDelete(Request $request, $id){
        $worker = Worker::find($id);
        if( is_null($worker))
        {
            return response()->json(['error'=>true, 'message'=>'Not found'], 404);
        }
        $worker->delete();
        return response()->json('Deleted', 204);
    }
}
