<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Order;
use App\Cup;
use Carbon\Carbon;

class OrderController extends Controller
{
    //show
    public function show($id){
        $order = Order::with(['owner' => function ($query){
            $query->select('id', 'name');
        }])->where('id', '=', $id)->firstOrFail();

        // return $order;
        return view('orders/showOrder', [
            'order' => $order,
        ]);
    }

    //create
    public function create(){
        return view('orders/placeOrder');
    }

    //store
    public function store(Request $req){
        $dateTime = Carbon::now();
        //create a cup for the order.
        $cup = new Cup;
        $cup->coffee_ordered = 0;
        $cup->created_at = $dateTime;
        $cup->owner = Auth::user()->id;
        $cup->save();

        //create a order
        $order = new Order;
        $order->clip = $req->clip;
        $order->engraving = $req->engraving;
        $order->front_img = $req->front_img;
        $order->back_img = $req->back_img;
        $order->ordered_at = $dateTime;
        $order->location = $req->location;
        $order->status = "not payed";
        //give the cup and owner id
        $order->cup_id = $cup->id;
        $order->owner = Auth::user()->id;

        $order->save();

        return "created succesfully!";
    }

    //edit
    public function edit($id){
        $order = Order::findOrFail($id);

        return view('orders.editOrder', [
            'order' => $order,
        ]);
    }

    //update
    public function update(Request $req ,$id){

        //find corresponding order.
        $order = Order::findOrFail($id);

        //update data
        $order->clip = $req->clip;
        $order->engraving = $req->engraving;
        $order->front_img = $req->front_img;
        $order->back_img = $req->back_img;
        $order->location = $req->location;
        $order->cup_id = $req->cup_id;
        $order->owner = $req->owner;
        
        $order->save();

        return "updated succesfully!";
    }
}