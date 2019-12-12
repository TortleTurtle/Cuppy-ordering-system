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
        $this->middleware('auth');
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
    }])->where('user_id', '=', (auth()->user()->id) )->get();
//        dd($cup);

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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function Plus_coffee(Request $request, $id)
    {
        $Coffee = cup::find($id);
        $Coffee->coffee_ordered = $Coffee->coffee_ordered+1;
        $Coffee->save();

        return redirect('/cup')->with('success', 'Post Updated');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function min_coffee(Request $request, $id)
    {
        $Coffee = cup::find($id);
        $Coffee->coffee_ordered = $Coffee->coffee_ordered-1;
        $Coffee->save();

        return redirect('/cup')->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cup = cup::find($id);

        //Check for correct user
        if(auth()->user()->id !==$cup->user_id){
            return redirect('posts')->with('error', 'Unauthorized page');
        }

        $cup->delete();
        return redirect('/cup')->with('success', 'cup Removed');
    }
}
