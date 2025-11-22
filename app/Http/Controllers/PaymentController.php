<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function viewCheckout($id)
    {
        $fatchPlan = Plan::find(base64_decode($id));
        return view('payment.payment', compact('fatchPlan'));
    }
    public function binancePay(){
        return view('payment.payment-binance');
    }
}
