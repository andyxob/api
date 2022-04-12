<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShopController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/shop/",
     *     @OA\Response(response="200", description="Display a listing of shops.")
     * )
     */

    public function shops(){
        return response()->json(Shop::get(), 200);
    }


    /**
     * @OA\Get(
     *     path="/api/shop/{id}",
     *     @OA\Response(response="200", description="Display shop by id.")
     * )
     */
    public  function shopById($id){
        $shop = Shop::find($id);
        if( is_null($shop))
        {
            return response()->json(['error'=>true, 'message'=>'Not found'], 404);
        }
        return response()->json($shop, 200);

    }

    /**
     * @OA\Post (
     *     path="/api/shop/add",
     *     @OA\Response(response="201", description="Add shop.")
     * )
     */

    public function shopAdd(Request $request){
        $rules = ['name'=>'required|min:4',
            'department'=>'required'];



        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $shop = Shop::create($request->all());
        return response()->json($shop, 201);
    }
    /**
     * @OA\Put (
     *     path="/api/shop/{id}",
     *     @OA\Response(response="200", description="Edit shop.")
     * )
     */

    public function shopEdit(Request $request, $id){
        $shop = Shop::find($id);
        if( is_null($shop))
        {
            return response()->json(['error'=>true, 'message'=>'Not found'], 404);
        }
        $rules = ['name'=>'required|min:4',
            'department'=>'required'];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $shop->update($request->all());
        return response()->json($shop, 200);
    }

    /**
     * @OA\Delete (
     *     path="/api/shop/{id}",
     *     @OA\Response(response="204", description="Delete.")
     * )
     */

    public function shopDelete(Request $request, $id){
        $shop = Shop::find($id);
        if( is_null($shop))
        {
            return response()->json(['error'=>true, 'message'=>'Not found'], 404);
        }
        $shop->delete();
        return response()->json('Deleted', 204);
    }
}
