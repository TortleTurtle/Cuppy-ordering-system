<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Order;
use App\User;
use App\Cup;
use Carbon\Carbon;

class OrderController extends Controller
{
    //index orders
    public function index(Request $req){
        if(in_array("read", $req->get('permissions'))){
            $orders = Order::with(['owner' => function ($query){
                $query->select('id', 'name');
            }])->get();
    
            //return $orders;
            return view('orders/Orders', compact('orders'));
        }
        else {
            return abort(403, "Sorry you do not have the right permissions");
        }
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

        return redirect()->route('orders.show', ['id' => $order->id]);
    }

    //edit
    public function edit($id, Request $req){
        if (in_array("write", $req->get('permissions'))) {
            $order = Order::findOrFail($id);

            return view('orders.edit', [
                'order' => $order,
            ]);
        } else {
            abort(403, "Sorry you do not have the right permissions");
        }
    }

    //update
    public function update(Request $req ,$id){
        if (in_array("write", $req->get('permissions'))){
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
        } else {
            return abort(403, "Sorry you do not have the right permissions");
        }
    }

    //delete
    public function delete($id, Request $req){
        if (in_array('delete', $req->get('permissions'))) {
            $deletedOrder = Order::destroy($id);
    
            if ($deletedOrder){
                return redirect()->route('orders.index');
            }
            else{
                return "Oops something went wrong";
            }
        } else {
            abort(403, "Sorry you do not have the right permissions");
        }
    }
}