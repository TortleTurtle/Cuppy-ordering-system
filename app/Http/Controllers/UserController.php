<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        if(in_array("read", $req->get('permissions'))){
            $users = User::select('id', 'name', 'email')->withCount(['cups', 'orders'])->get();
    
            return view('users.index', compact('users'));
        } else {
            return abort(403, "Sorry you do not have the right permissions");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $req)
    {
        if(in_array("read", $req->get('permissions'))){
            $user = User::with('cups', 'orders')->findOrFail($id);
    
            return view('users.show', compact('user'));
        } else {
            return abort(403, "Sorry you do not have the right permissions");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $req)
    {
        if(in_array("write", $req->get('permissions'))){
            $user = User::select('id', 'name', 'email')->findOrFail($id);
    
            return view('users.edit', compact('user'));
        } else {
            return abort(403, "Sorry you do not have the right permissions");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        if(in_array("write", $req->get('permissions'))){
            $user = User::findOrFail($id);
    
            $user->name = $req->name;
            $user->email = $req->email;
    
            $user->save();
    
            return redirect()->route('users.show', ['id' => $id]);
        } else {
            return abort(403, "Sorry you do not have the right permissions");
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
        if (in_array("delete", $req->get('permissions'))) {
        } else {
            return abort(403, "Sorry you do not have the right permissions");
        }
    }
}