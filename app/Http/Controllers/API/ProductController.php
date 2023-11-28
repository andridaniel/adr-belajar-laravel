<?php

namespace App\Http\Controllers\API;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::all();     
            return response()->json([
                'status' => 'success',
                'message' => 'data berhasil ditemukan',
                'data' => $product
            ]);
    }

    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                'status' => 'error',
                'message' => 'data tidak ditemukan',
                'data' => null
            ], 404);
        }else{
            return response()->json([
                'status' => 'success',
                'message' => 'data berhasil ditemukan',
                'data' => $product
            ]);
        }
    }


    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'product_name' => 'required',
            'category_id' => 'required',
            'product_code' => 'required',
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required',
            // 'gambar.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'data tidak valid',
                'data' => null
            ] , 422);
        }

        // Upload gambar
        // $gambarArray = $this->upload($request->file('gambar'));

        $product = Product::create([
            'product_name' => $request->input('product_name'),
            'category_id' => $request->input('category_id'),
            'product_code' => $request->input('product_code'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
            // 'image' => $gambarArray,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'data telah dibuat',
            'data' => $product
        ]);
    }

    public function update(Request $request, $id){

        $validate = Validator::make($request->all(),[
            'product_name' => 'required',
            'category_id' => 'required',
            'product_code' => 'required',
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'data tidak valid',
                'data' => $validate->errors()
            ] , 422);
        }

        $product = Product::where ('id', $id)->update([
            'product_name' => $request->input('product_name'),
            'category_id' => $request->input('category_id'),
            'product_code' => $request->input('product_code'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
        ]);

        if ($product) {
            $product = Product::find($id);
            return response()->json([
                'status' => 'success',
                'message' => 'data telah berhasil diupdate',
                'data' => $product
            ]);
        }
    }


    public function destroy($id){
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                'status' => 'error',
                'message' => 'data tidak ditemukan',
                'data' => null
            ], 422);
        }
        $product->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'data telah dihapus',
                'data' => null
            ]);
     
    }
}
