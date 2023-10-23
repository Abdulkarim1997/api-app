<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Validator;
class ProductController extends Controller
{
    public function index(){
        $product= Product::all();
        return response()->json([
            'success' => true,
            'message' =>'All Products',    
            'data'=>$product
        ],200);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' =>'required',
            'details' =>'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
              'success' => false,
              'message' => $validator->errors()
            ], 400);
        }
        $product = Product::create([
            'name' => $request->name,
            'details' => $request->details,
        ]);
        return response()->json([
          'success' => true,
          'message' => 'Product Created',
            'data' => $product
        ], 200);
    }

    public function show($id){
        $product = Product::find($id);
        if (is_null($product)) {
            return response()->json([
              'success' => false,
              'message' => 'Product Not Found'
            ], 404);
        }
        return response()->json([

          'success' => true,

         'message' => 'Product Fetched Successfully',
            'data' => $product
        ], 200);
    }
  
    public function update(Request $request,Product $product){
        $input =$request->all();
        $validator = Validator::make($input, [
            'name' =>'required',
            'details' =>'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
              'success' => false,
              'message' => $validator->errors()
            ], 400);
        }
        $product ->name = $input['name'];
         $product ->details = $input['details'];
         $product ->save();
        return response()->json([
          'success' => true,
          'message' => 'Product Updated Successfully',
            'data' => $product
        ], 200);
    }

    public function destroy(Product $product){
        $product->delete();
        return response()->json([
         'success' => true,
        'message' => 'Product Deleted Successfully',
            'data' => $product
        ], 200);
    }

}



