<?php

namespace App\Http\Controllers;

use App\Cup;
use App\User;
use Illuminate\Http\Request;

class CupController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $posts = post::orderBy('created_at', 'desc')->get();
        $cup = cup::orderby('id', 'desc')->get();
        $users = user::orderby('id', 'desc')->get();
        dd($cup);
        return view('cup.index')->with('cup', $cup);
    }
}
