<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  getting list of users on index for route get-users defined in api.php
    public function index()
    {
        $users = User::get();
        /**
         * for API we send Json for now i am just returning value to speedup things
         */
        return $users;
    }
    public function login(Request $request)
    {
        $user = User::where('email',$request->email)->where('password', $request->password)->first();
        if ($user) {
            $token = $user->createToken('token-name');
            return $token->plainTextToken;
        } else {
            return 'not found';
        }
    }

    /**
     * protected route method implementation
     */
    public function protectedRoute(Request $request)
    {
        return 'string from protected route';
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
        $user = new User;
        if($request->name && $request->email && $request->password){
            $user->name=$request->name;
            $user->email=$request->email;
            $user->password=$request->password;
            $user->save();
            return  response()->json(['user' => $user], 200);
        } else{
            return "name , email, password is required parameter";
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
        $id= auth()->user()->id;
        $user= User::findOrFail($id);
        // if($request->name){
        //     $user->name=$request->name;
        // } if($user->email){
        //     $user->email= $request->email;
        // } if($user->password){
        //     $user->password =$request->passthru
        // }

        if($request->name || $request->email || $request->password){

            $user->name=isset($request->name) ? $request->name : $user->name;
            $user->email=isset($request->email) ? $request->name : $user->email;
            $user->password=isset($request->password) ? $request->password : $user->password;
            $user->save();
            return $user;
        } else{
            return 'name,email,password is required parameters';
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
        $id= auth()->user()->id;
        $user= User::findOrFail($id);
        if($user && $user->delete() ){
            return $user->id.' user deleted';
        } else{
            return 'error in deleting';
        }
    }
    public function logout(){
        // $user->currentAccessToken()->delete();
    }
}
