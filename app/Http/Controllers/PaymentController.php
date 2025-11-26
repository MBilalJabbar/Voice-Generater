<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function viewCheckout($id)
    {
        $fatchPlan = Plan::find(base64_decode($id));
        if(!Auth::check()){
            $fatchPlan->user = Auth::user();
            return view('auth.login');

        }
        return view('payment.payment', compact('fatchPlan'));
    }
    public function binancePay(){
        $users = Auth::user();
        return view('payment.payment-binance', compact('users'));
    }

    public function usdtPay(){
        $users = Auth::user();
        return view('payment.payment-usdt', compact('users'));
    }
}
