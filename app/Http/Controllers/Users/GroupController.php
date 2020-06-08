<?php

namespace App\Http\Controllers\Users;

use Exception;
use App\Models\Group;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Group as ResourcesGroup;
use Illuminate\Support\Facades\Validator;

class GroupController extends Controller
{
    public function view()
    {
        return view('groups.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ResourcesGroup::collection(Group::all());
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
            'name'        => 'required|string|min:4|max:20|unique:users_groups,name',
            'description' => 'required|string|min:4|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }

        $group = Group::create([
            'name'        => $request['name'],
            'description' => $request['description']
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => trans('app.groups.created', ['group' => $group->name])
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|min:4|max:20|unique:users_groups,name,' . $group->id,
            'description' => 'required|string|min:4|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }

        $group->update([
            'name' => $request['name'],
            'description' => $request['description']
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => trans('app.groups.updated', ['group' => $group->name])
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        $group->delete();
        return response()->json([
            'status' => 'success',
            'message' => trans('app.groups.deleted', ['group' => $group->name])
        ]);
    }
}
