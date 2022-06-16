<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Session;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail; 
use App\Mail\OrderMail;


class PayPalController extends Controller
{
    public function PayPalOrder(Request $request){

        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                'ARcMxzVUTDb8WHazlaBifdNwwRlzQPJHJngmjb4CCSmw8nWSJBR66yHj7MjjBMNRsQ8Rz0RkEfVvZETw',     // ClientID
                'EDMmoZ5cGCtbZOrlCuwFPNPRYAwPLqGsJGNcZUfGk2tsfgxrNgKkgZ5v3620e2p7aRdtZIC6X7pRNyJC'      // ClientSecret
            )
    );

    // dd($apiContext);
    
    $payer = new \PayPal\Api\Payer();
    $payer->setPaymentMethod('paypal');

    $amount = new \PayPal\Api\Amount();
    $amount->setTotal('1.00');
    $amount->setCurrency('USD');

    $transaction = new \PayPal\Api\Transaction();
    $transaction->setAmount($amount);

    $redirectUrls = new \PayPal\Api\RedirectUrls();
    $redirectUrls->setReturnUrl(route('dashboard'))
    ->setCancelUrl(route('mycart'));

    $payment = new \PayPal\Api\Payment();
    $payment->setIntent('sale')
    ->setPayer($payer)
    ->setTransactions(array($transaction))
    ->setRedirectUrls($redirectUrls);


    try {
        $payment->create($apiContext);
        echo $payment;
    
        echo "\n\nRedirect user to approval_url: " . $payment->getApprovalLink() . "\n";

        return redirect($payment->getApprovalLink());
    }
    catch (\PayPal\Exception\PayPalConnectionException $ex) {
        // This will print the detailed information on the exception.
        //REALLY HELPFUL FOR DEBUGGING
        echo $ex->getData();
    }




    } // End Method







}
