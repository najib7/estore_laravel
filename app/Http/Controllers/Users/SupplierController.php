<?php

namespace App\Http\Controllers\Users;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Supplier as SupplierResource;

class SupplierController extends Controller
{
    public function view()
    {
        return view('store.suppliers');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SupplierResource::collection(Supplier::all());
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
            'name'    => 'required|string|min:2|max:30',
            'phone'   => 'required|numeric',
            'email'   => 'required|string|email|max:255|unique:suppliers',
            'address' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }

        $client = Supplier::create($request->all());
        return response()->json([
            'status' => 'success',
            'message' => trans('app.suppliers.created')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        $validator = Validator::make($request->all(), [
            'name'    => 'required|string|min:2|max:30',
            'phone'   => 'required|numeric',
            'email'   => 'required|string|email|max:255|unique:suppliers,email,' . $supplier->id,
            'address' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }

        $supplier->update($request->all());
        return response()->json([
            'status' => 'success',
            'message' => trans('app.suppliers.updated', ['supplier' => $supplier->name])
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return response()->json([
            'status' => 'success',
            'message' => trans('app.suppliers.deleted', ['supplier' => $supplier->name])
        ]);

    }
}
