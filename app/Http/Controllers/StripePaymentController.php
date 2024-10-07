<?php
      
namespace App\Http\Controllers;
       
use Stripe;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
       
class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        return view('stripe');
    }
      
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe(Request $request): RedirectResponse
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
      
        Stripe\Charge::create ([
                "amount" => 10 * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Stripe Test Payment" 
        ]);
                
        return back()->with('success', 'Payment has been successful');
    }
}
 