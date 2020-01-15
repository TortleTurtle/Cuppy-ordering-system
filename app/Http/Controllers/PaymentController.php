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
            'redirectUrl' => route('orders.index'),
            ]);
            
        $payment = Mollie::api()->payments()->get($payment->id);

        // redirect customer to Mollie checkout page
        return redirect($payment->getCheckoutUrl(), 303);
        
    }

    public function paid()
    {
        $payment = Mollie::api()->payments()->get($payment->id);
        
        if ($payment -> isPaid()) {
            return view('users.paid');
        } else {
            return view('users.notPaid');
        }
    }
}
