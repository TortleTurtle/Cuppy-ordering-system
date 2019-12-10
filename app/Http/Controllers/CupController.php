<?php

namespace App\Http\Controllers;

use App\Cup;
use App\User;
use Carbon\Carbon;
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
        $cup = cup::with(['owner' => function ($query){
        $query->select('id', 'name');
    }])->get();

        return view('cup.index', compact('cup'));
    }

    //store
    public function store(Request $request){
        cup::create([
            'coffee_ordered' => 0,
            'user_id' => (auth()->user()->id),
            'created_at'=> Carbon::now()
        ]);

        return redirect('/cup')->with('Succes', 'Cup account linked');
    }
}
