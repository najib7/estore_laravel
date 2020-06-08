<?php

namespace App\Http\Controllers\Store;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Product as ProductResource;

class ProductController extends Controller
{
    public function view()
    {
        return view('products.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Product::with('category:id,name')->get();
        return ProductResource::collection(Product::all());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string',
            'image'    => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'quantity' => 'required|numeric|min:1|max:100000',
            'price'    => 'required|numeric|min:0.01|max:100000',
            'category' => 'required|numeric|exists:products_categories,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }

        $product = new Product();
        $product->name = $request->name;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->category_id = $request->category;
        $product->image = upload_image($request->image, $product->name, 'products');
        $product->save();

        return response()->json([
            'status'  => 'success',
            'message' => trans('app.products.created', ['product' => $product->name])
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string',
            'image'    => 'image|mimes:jpeg,png,jpg|max:2048',
            'quantity' => 'required|numeric|min:1|max:100000',
            'price'    => 'required|numeric|min:0.01|max:100000',
            'category' => 'required|numeric|exists:products_categories,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }

        $product->name        = $request->name;
        $product->quantity    = $request->quantity;
        $product->price       = $request->price;
        $product->category_id = $request->category;
        $product->image       = upload_image($request->image, $request->name, 'products', $product->image);

        $product->save();

        return response()->json([
            'status' => 'success',
            'message' => trans('app.products.updated', ['product' => $product->name])
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $image = public_path('storage/products/' . $product->image);
        
        // delete old image
        if (File::exists($image)) {
            File::delete($image);
        }

        $product->delete();
        return response()->json(['status' => 'success', 'message' => trans('app.products.deleted', ['product' => $product->name])]);
    }
}
