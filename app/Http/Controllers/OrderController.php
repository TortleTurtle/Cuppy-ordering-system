<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Order;
use App\User;
use App\Cup;
use Mollie\Laravel\Facades\Mollie;
use Carbon\Carbon;

class OrderController extends Controller
{
    //index orders
    public function index(){
        $orders = Order::with(['owner' => function ($query){
            $query->select('id', 'name');
        }])->get();

//        return $orders;
        return view('orders/index', compact('orders'));
    }


    //show
    public function show($id){
         $order = Order::with(['owner' => function ($query){
             $query->select('id', 'name');
         }])->where('id', '=', $id)->firstOrFail();

        return view('orders/show', compact('order'));
    }

    //create
    public function create(){

        return view('orders/place');
    }

    //store
    public function store(Request $req){
        $dateTime = Carbon::now();
        //create a cup for the order.
        $cup = new Cup;
        $cup->coffee_ordered = 0;
        $cup->created_at = $dateTime;
        $cup->user_id = Auth::user()->id;
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
        //give the cup and user_id
        $order->cup_id = $cup->id;
        $order->user_id = Auth::user()->id;

        $order->save();

        return redirect()->action('OrderController@pay');
        // return redirect()->route('orders.show', ['id' => $order->id]);
    }

public function pay()
{
    $payment = Mollie::api()->payments()->create([
        'amount' => [
            'currency' => 'EUR',
            'value' => '10.00', // You must send the correct number of decimals, thus we enforce the use of strings
        ],
        'description' => 'My first API payment',
        'webhookUrl' => route('webhooks.mollie'),
        'redirectUrl' => route('orders.index'),
        ]);

        $payment = Mollie::api()->payments()->get($payment->id);

        // redirect customer to Mollie checkout page
        return redirect($payment->getCheckoutUrl(), 303);
}

    //edit
    public function edit($id){
        $order = Order::findOrFail($id);

        return view('orders.edit', [
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
        $order->status = $req->status;
        $order->user_id = $req->user_id;

        $order->save();

        return redirect()->route('orders.show', ['id' => $id]);
    }

    //delete
    public function delete($id){
        $deletedOrder = Order::destroy($id);

        if ($deletedOrder){
            return redirect()->route('orders.index');
        }
        else{
            return "Oops something went wrong";
        }
    }
}
