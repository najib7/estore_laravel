<?php

namespace App\Http\Controllers\Users;

use Exception;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserPrivilege as ResourcesUserPrivilege;
use App\Models\Group;
use App\Models\UserPrivilege;
use Illuminate\Support\Facades\Validator;

class PrivilegesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prv = ResourcesUserPrivilege::collection(UserPrivilege::all());

        // dd($prv->groupBy('model')->toArray());
        return $prv->groupBy('model')->toArray();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'group' => 'required|numeric|exists:users_groups,id',
        ]);

        $group = Group::find($request->group);
        $privileges = explode(',', $request->privileges);
        $group->privileges()->sync($privileges);

        return response()->json([
            'status'  => 'success',
            'message' => trans('app.privileges.created')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(UserPrivilege $privilege)
    {
        return new ResourcesUserPrivilege($privilege);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserPrivilege $privilege)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserPrivilege $privilege)
    {

    }
}
