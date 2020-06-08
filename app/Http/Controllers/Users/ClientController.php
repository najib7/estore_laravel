<?php

namespace App\Http\Controllers\Users;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Client as ClientResource;

class ClientController extends Controller
{

    public function view()
    {
        return view('store.clients');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ClientResource::collection(Client::all());
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
            'phone'   => 'required|size:10',
            'email'   => 'required|string|email|max:255|unique:clients',
            'address' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }

        $client = Client::create($request->all());
        return response()->json(['status' => 'success', 'message' => trans('app.clients.created')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $validator = Validator::make($request->all(), [
            'name'    => 'required|string|min:2|max:30',
            'phone'   => 'required|size:10',
            'email'   => 'required|string|email|max:255|unique:clients,email,' . $client->id,
            'address' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }

        $client->update($request->all());
        return response()->json(['status' => 'success', 'message' => trans('app.clients.updated', ['client' => $client->name])]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        try {
            $client->delete();
        } catch(Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'error']);
        }

        return response()->json(['status' => 'success', 'message' => trans('app.clients.deleted', ['client' => $client->name])]);
    }
}
