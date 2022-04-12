<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/dep/",
     *     @OA\Response(response="200", description="Display a listing of departments.")
     * )
     */

    public function departments(){
        return response()->json(Department::get(), 200);
    }


    /**
     * @OA\Get(
     *     path="/api/dep/{id}",
     *     @OA\Response(response="200", description="Display department by id.")
     * )
     */

    public  function depById($id){
        $dep = Department::find($id);
        if( is_null($dep))
        {
            return response()->json(['error'=>true, 'message'=>'Not found'], 404);
        }
        return response()->json($dep, 200);

    }

    /**
     * @OA\Post (
     *     path="/api/dep/add",
     *     @OA\Response(response="201", description="Add new department.")
     * )
     */
    public function depAdd(Request $request){
        $rules = ['name'=>'required|min:4',
            'location'=>'required|min:4'];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
            $dep = Department::create($request->all());
        return response()->json($dep, 201);
    }

    /**
     * @OA\Put(
     *     path="/api/dep/{id}",
     *     @OA\Response(response="200", description="Update department`s value.")
     * )
     */

    public function depEdit(Request $request, $id){
        $dep = Department::find($id);
        if( is_null($dep))
        {
            return response()->json(['error'=>true, 'message'=>'Not found'], 404);
        }
        $rules = ['name'=>'required|min:4',
            'location'=>'required|min:4'];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $dep->update($request->all());
        return response()->json($dep, 200);
    }

    /**
     * @OA\Delete (
     *     path="/api/dep/{id}",
     *     @OA\Response(response="204", description="Delete.")
     * )
     */

    public function depDelete($id){
        $dep = Department::find($id);
        if( is_null($dep))
        {
            return response()->json(['error'=>true, 'message'=>'Not found'], 404);
        }
        $dep->delete();
        return response()->json('Deleted', 204);
    }
}
