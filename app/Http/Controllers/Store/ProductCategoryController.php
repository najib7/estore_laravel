<?php

namespace App\Http\Controllers\Store;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProductCategoryController extends Controller
{
    public function view()
    {
        return view('products.categories');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProductCategory::all();
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
            'name'        => 'required|string',
            'description' => 'required|string|min:4|max:250',
            'image'       => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }

        $category = new ProductCategory();
        $category->name        = $request->name;
        $category->description = $request->description;
        $category->image = upload_image($request->image, $category->name, 'p_category');
        $category->save();

        return response()->json([
            'status'  => 'success',
            'message' => trans('app.products_categories.created', ['category' => $category->name])
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductCategory $productscategory)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string',
            'description' => 'required|string|min:4|max:250',
            'image'       => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }

        $productscategory->name        = $request->name;
        $productscategory->description = $request->description;
        $productscategory->image = upload_image($request->image, $request->name, 'p_category', $productscategory->image);

        $productscategory->save();

        return response()->json([
            'status'  => 'success',
            'message' => trans('app.products_categories.updated', ['category' => $productscategory->name])
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCategory $productscategory)
    {
        $productscategory->delete();
        $image = public_path('storage/p_category/' . $productscategory->image);
        // delete old image
        if (File::exists($image)) {
            File::delete($image);
        }
        return response()->json([
            'status'  => 'success',
            'message' => trans('app.products_categories.deleted', ['category' => $productscategory->name])
        ]);
    }
}
