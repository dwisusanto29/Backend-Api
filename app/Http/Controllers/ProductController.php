<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::all();

        return response()->json([
            'message' => 'Successfully get all products',
            'data' => $data
        ], 200);
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

        $check_product = Product::where('name', $request->name)->first();
        if($check_product){
            return response()->json([
                'message' => 'Product already exists'
            ], 400);
        }

        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->detail = $request->detail;
        $product->image = $request->image;
        $product->save();

        return response()->json([
            'message' => 'Successfully create product',
            'data' => $product
        ], 201);

    }

    public function show(Request $request)
    {
        $product = Product::find($request->input('id'));

        if(!$product){
            return response()->json([
                'message' => 'Product not found'
            ], 404);
        }

        return response()->json([
            'message' => 'Successfully get product',
            'data' => $product
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $product_id = $request->input('id');
        $product = Product::find($product_id);
        DB::beginTransaction();
        try{
            $product->name = $request->name;
            $product->price = $request->price;
            $product->detail = $request->detail;
            $product->image = $request->image;
            $product->save();

            DB::commit();
            return response()->json([
                'message' => 'Successfully update product',
                'data' => $product
            ], 201);
        } catch(\Exception $e){
            DB::rollback();
            return response()->json([
                'message' => 'Something went wrong'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $product_id = $request->input('id');
        $product = Product::find($product_id);

        if(!$product){
            return response()->json([
                'message' => 'Product not found'
            ], 404);
        }

        DB::beginTransaction();
        try{
            $product->delete();

            DB::commit();
            return response()->json([
                'message' => 'Successfully delete product',
                'data' => $product
            ], 200);
        } catch(\Exception $e){
            DB::rollback();
            return response()->json([
                'message' => 'Something went wrong'
            ], 500);
        }
    }

}
