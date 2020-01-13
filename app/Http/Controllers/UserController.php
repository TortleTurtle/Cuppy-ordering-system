<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        checkPermission('read', $req);
    
        $users = User::select('id', 'name', 'email')->withCount(['cups', 'orders'])->get();

        return view('users.index', compact('users'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $req)
    {
        $user = User::with('cups', 'orders')->findOrFail($id);

        if (!(Auth::user()->id == $user->id)){
            checkPermission('read', $req);
        }

        return view('users.show', compact('user'));        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $req)
    {
        $user = User::with(['role'])->select('id', 'name', 'email', 'role_id')->findOrFail($id);

        if(Auth::user()->id == $id){
            return view('users.edit', compact('user'));
        } else {
            //admins can also change a users role.
            checkPermission('write', $req);
            return view('admin.userEdit', compact('user'));
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
        if(Auth::user()->id == $id){
            $user = User::findOrFail($id);
    
            $user->name = $req->name;
            $user->email = $req->email;
    
            $user->save();
    
            return redirect()->route('users.show', ['id' => $id]);
        } else {
            //admins can also change a users role.
            checkPermission('write', $req);

            $user = User::findOrFail($id);

            $user->name = $req->name;
            $user->email = $req->email;
            $user->role_id = $req->role_id;

            $user->save();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $req)
    {
        checkPermission('delete', $req);
    }
}