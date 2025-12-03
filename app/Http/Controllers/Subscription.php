<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Subscription as ModelsSubscription;
use App\Models\User;
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
        $durationDays = (int) $plan->duration; // convert string to integer
        $end = now()->addDays($durationDays);
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
        return redirect('binancePay/'.$subscription->id);
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

    public function FreePlanActive($id){
        $plan_id = base64_decode($id);
        $plan = Plan::find($plan_id);
        if(!$plan){
            return redirect()->back()->with('error', 'Plan not found');
        }

        $user = Auth::user();
        if(!$user){
            return redirect('/login');
        }

        $alreadyUsed = User::where('email', $user->email)
                            ->where('free_plan_used', true)
                            ->exists();
        if($plan->price == 0 && $alreadyUsed){
            return redirect('/')->with('error', 'You already used the free plan.');
        }

        $user->credits = $plan->characters;
        $user->current_plan_id = $plan->id;
        $user->plan_name = $plan->name;
        $user->plan_expiry_date = now()->addDays((int)$plan->duration)->endOfDay();

        if($plan->price == 0){
            $user->free_plan_used = true;
        }

        $user->save();


        return redirect('/index')->with('success', 'Free plan activated successfully!');
    }

}
