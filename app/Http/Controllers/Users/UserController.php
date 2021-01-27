<?php

namespace App\Http\Controllers\Users;

use Exception;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\User as UserResource;

class UserController extends Controller
{

    public function view()
    {
        $this->authorize('show', User::class);
        return view('users.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('show', User::class);
        return UserResource::collection(User::all()->except(Auth::id()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', User::class);

        $validator = Validator::make($request->all(), [
            'username'   => 'required|alpha_dash|min:3|max:20|unique:users',
            'first_name' => 'required|string|min:2|max:30',
            'last_name'  => 'required|string|min:2|max:30',
            'email'      => 'required|string|email|max:255|unique:users',
            'password'   => 'required|string|min:8|max:255',
            'gender'     => 'required|in:male,female',
            'image'      => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'address'    => 'required|string|max:255',
            'dob'        => 'date|before:5 years ago|nullable',
            'phone'      => 'required|numeric',
            'group' => 'required|numeric|exists:users_groups,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }

        $user = User::create([
            'username' => $request['username'],
            'email'    => $request['email'],
            'password' => Hash::make($request['password']),
            'group_id' => $request['group']
        ]);

        Profile::create([
            'user_id'       => $user->id,
            'first_name'    => $request['first_name'],
            'last_name'     => $request['last_name'],
            'gender'        => $request['gender'],
            'image'         => upload_image($request['image'], $user->username, 'profiles'),
            'address'       => $request['address'],
            'date_of_birth' => $request['dob'],
            'phone'         => $request['phone'],
        ]);

        return response()->json(['status' => 'success', 'message' => trans('app.users.created')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {

        return 'test';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('update', User::class);


        $validator = Validator::make($request->all(), [
            'username'   => 'required|alpha_dash|min:3|max:20|unique:users,username,' . $user->id,
            'first_name' => 'required|string|min:2|max:30',
            'last_name'  => 'required|string|min:2|max:30',
            'email'      => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password'   => 'sometimes|string|min:8|max:255',
            'gender'     => 'required|in:male,female',
            'image'      => 'image|mimes:jpeg,png,jpg|max:2048',
            'address'    => 'required|string|max:255',
            'dob'        => 'date|before:5 years ago|nullable',
            'phone'      => 'required|numeric',
            'group'      => 'required|numeric|exists:users_groups,id'
        ]);


        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }

        $user->update([
            'username' => $request['username'],
            'email'    => $request['email'],
            'group_id' => $request['group']
        ]);

        $user->profile()->update([
            'first_name'    => $request['first_name'],
            'last_name'     => $request['last_name'],
            'gender'        => $request['gender'],
            'address'       => $request['address'],
            'date_of_birth' => $request['dob'],
            'phone'         => $request['phone'],
            'image'         => upload_image($request['image'], $user->username, 'profiles', $user->profile->image)
        ]);

        return response()->json(['status' => 'success', 'message' => trans('app.users.updated', ['user' => $user->username])]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', User::class);

        $image = public_path('storage/profiles/' . $user->profile->image);
        // delete old image
        if (File::exists($image)) {
            File::delete($image);
        }

        try {
            $user->delete();
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'error']);
        }

        return response()->json(['status' => 'success', 'message' => trans('app.users.deleted', ['user' => $user->username])]);
    }
}
