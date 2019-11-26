<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Order;
use App\Cup;
use Carbon\Carbon;

class OrderController extends Controller
{
    //create order
    public function create(){
        return view('orders/placeOrder');
    }

    //store order
    public function store(Request $request){
        $dateTime = Carbon::now();

        $cup = new Cup;
        $cup->created_at = $dateTime;
        $cup->owner = Auth::user()->id;
        $cup->save();

        $order = new Order;
        $order->clip = $request->clip;
        $order->engraving = $request->engraving;
        $order->front_img = $request->front_img;
        $order->back_img = $request->back_img;
        $order->ordered_at = $dateTime;
        $order->location = $request->location;
        $order->cup_id = $cup->id;
        $order->owner = Auth::user()->id;

        $order->save();

        return "succes!";
    }
}