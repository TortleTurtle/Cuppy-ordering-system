<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mollie\Laravel\Facades\Mollie;

class PaymentController extends Controller
{
    //goes to this page when you order a cuppy
    public function pay()
    {
        $payment = Mollie::api()->payments()->create([
            'amount' => [
                'currency' => 'EUR',
                'value' => '10.00', // You must send the correct number of decimals, thus we enforce the use of strings
            ],
            'description' => 'CUPPY™ beker',
            'locale' => 'nl_NL',
            'webhookUrl' => route('webhooks.mollie'),
            'redirectUrl' => route('orders.success'),
            ]);
            
        $payment = Mollie::api()->payments()->get($payment->id);

        // redirect customer to Mollie checkout page
        return redirect($payment->getCheckoutUrl(), 303);
        
        if ($payment -> isPaid()) {
            return view('orders.paid');
        } else {
            return view('orders.notPaid');
        }
    }

    public function paid()
    {
      
            return view('orders.paid');
       
    }
    public function notPaid()
    {
      
            return view('orders.notPaid');
       
    }
}
