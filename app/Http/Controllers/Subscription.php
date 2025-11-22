<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Subscription as ModelsSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Subscription extends Controller
{
    public function progressCheckout(Request $request){
        $request->validate([
            'payment_method' => 'required|string|in:binance,usdt,card',
            'plan_id' => 'required|integer|exists:plans,id',
        ]);
        $plan = Plan::findOrFail($request->plan_id);

    $start = now();
    $end = now()->addDays($plan->duration ?? 30);

    // CREATE subscription record
    $subscription = ModelsSubscription::create([
        'user_id' => Auth::id(),
        'plan_id' => $plan->id,
        'payment_method' => $request->payment_method,
        'amount' => $plan->price,
        'currency' => "USD",
        'start_date' => $start,
        'end_date' => $end,
        'payment_status' => "pending",
    ]);

    // BINANCE PAYMENT
    if ($request->payment_method === 'binance') {
        return redirect('crypto/binance/'.$subscription->id);
    }

    // USDT PAYMENT
    if ($request->payment_method === 'usdt') {
        return redirect('crypto/usdt/'.$subscription->id);
    }

    // CARD PAYMENT
    if ($request->payment_method === 'card') {
        return redirect('card/pay/'.$subscription->id);
    }

    return back()->with('error', 'Invalid payment method selected.');

    }

    public function binance($id)
    {
        $subscription = ModelsSubscription::findOrFail($id);

        return view('payments.binance', compact('subscription'));
    }

    public function binancePay(Request $request, $id)
    {
        $request->validate([
            'transaction_id' => 'required',
        ]);

        $subscription = ModelsSubscription::findOrFail($id);

        $subscription->update([
            'transaction_id' => $request->transaction_id,
            'payment_status' => "pending",
        ]);

        return redirect('/thank-you')->with('success', 'Binance proof submitted. Awaiting admin approval.');
    }

    public function usdt($id)
    {
        $subscription = ModelsSubscription::findOrFail($id);

        return view('payments.usdt', compact('subscription'));
    }

    public function usdtPay(Request $request, $id)
    {
        $request->validate([
            'transaction_id' => 'required',
        ]);

        $subscription = ModelsSubscription::findOrFail($id);

        $subscription->update([
            'transaction_id' => $request->transaction_id,
            'payment_status' => "pending"
        ]);

        return redirect('/thank-you')->with('success', 'USDT hash submitted. Admin will verify soon.');
    }

}
