<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $this->authorize('create', User::class);
        //if(\Auth::user()->role == 'admin') {
        $users = User::latest()->paginate(10);
        return view('user.userlist', compact('users'));
        //}
    }

    
    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user= User::findOrFail($id);
        return view('user.userview', ['user' => $user]);
    }
    public static function showstatic($id)
    {
        $user= User::findOrFail($id);
        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('create', User::class);
        $user = User::findOrFail($id);
        return view('user.edituser', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('create', User::class);
        $user = User::findOrFail($id);
        if(isset($request->role)){
            $user->role = $request->role;
            $user->save();
        } else {
            $user->fname = $request->fname;
            $user->lname = $request->lname;
            $user->email = $request->email;
           
            $user->save();
        }
                
        return redirect('/users')->with('success', 'user updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('create', User::class);
        $user = User::findorFail($id);
        $user->delete();
        return redirect('/users')->with('success', 'user deleted!');
    }
}
