<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::paginate(10);

        return response()->json([
            'message' => 'Successfully get all products',
            'data' => $data
        ], 200);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $check_product = Product::where('name', $request->name)->first();
        if($check_product){
            return response()->json([
                'message' => 'Product already exists'
            ], 400);
        }

        DB::beginTransaction();
        try{
            $product = new Product();
            $product->name = $request->name;
            $product->price = $request->price;
            $product->detail = $request->detail;
            $product->image = $request->image;
            $product->quantity = $request->quantity;
            $product->created_by = Auth::user()->id;
            $product->save();

            DB::commit();
            return response()->json([
                'message' => 'Product created successfully',
                'data' => $product
            ], 201);

        } catch(\Exception $e){
            // DB::rollback();
            return response()->json([
                'message' => 'Something went wrong'
            ], 500);
        }
    }

    public function show(Request $request)
    {
        $product = Product::find($request->id);

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
        $product_name = $request->has('name') ? $request->input('name') : $product->name;
        $product_price = $request->has('price') ? $request->input('price') : $product->price;
        $product_detail = $request->has('detail') ? $request->input('detail') : $product->detail;
        $product_image = $request->has('image') ? $request->input('image') : $product->image;
        $product->quantity = $request->has('quantity') ? $request->input('quantity') : $product->quantity;
        DB::beginTransaction();
        try{
            $product->name = $product_name;
            $product->price = $product_price;
            $product->detail = $product_detail;
            $product->image = $product_image;
            $product->quantity = $product->quantity;
            $product->updated_by = Auth::user()->id;
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
