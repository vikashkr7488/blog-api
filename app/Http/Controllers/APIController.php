<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;

class APIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
		return UserResource::collection($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
		$user->name = $request->name;
		$user->email = $request->email;
		$user->password = Hash::make($request->password);
		$result = $user->save();
		if ($result) {
			//return ['result' => 'Data has been saved'];
			return new UserResource($user);
		}
		else {
			return ['result' => 'Operation failed'];
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
		return new UserResource($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
		$user->name = $request->name;
		$user->email = $request->email;
		$user->password = Hash::make($request->password);
		$result = $user->save();
		if ($result) {
			//return ['result' => 'Data has been saved'];
			return new UserResource($user);
		}
		else {
			return ['result' => 'Operation failed'];
		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findorFail($id);
		$result = $user->delete();
		if($result){
			//return ['result' => 'Data has been deleted'];
			return new UserResource($user);
		}
		else {
			return ['result' => 'Operation failed'];
		}
    }
}
