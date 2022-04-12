<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WorkerController extends Controller
{
    public function workers(){
        return response()->json(Worker::get(), 200);
    }

    public function workerById($id){
         $worker = Worker::find($id);
         if( is_null($worker))
         {
            return response()->json(['error'=>true, 'message'=>'Not found'], 404);
         }
         return response()->json($worker, 200);

    }

    public function workerAdd(Request $request){
        $rules = ['shop'=>'required',
            'department'=>'required',
            'name'=>'required|min:4|max:25',
            'surname'=>'required|min:4|max:25'];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $worker = Worker::create($request->all());
        return response()->json($worker, 201);
    }

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
