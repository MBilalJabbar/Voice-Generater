<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\User;
use App\Models\Plan;
use Illuminate\Support\Facades\Auth;

class PaymentProof extends Controller
{
    public function fetchPlan($id){
        $subscription = Subscription::with(['user', 'plan'])->find($id);

        if (!$subscription) {
            return response()->json([
                'success' => false,
                'message' => 'Subscription not found'
            ], 404);
        }

        // Calculate remaining days
        $end = \Carbon\Carbon::parse($subscription->user->plan_expiry_date); // corrected column name
    $daysRemaining = now()->startOfDay()->diffInDays($end->startOfDay(), false);

    // Attach remaining days to response
    $subscription->days_remaining = $daysRemaining > 0 ? $daysRemaining : 0;

        return response()->json([
            'success' => true,
            'data' => $subscription
        ]);
    }
    public function PlanStatusUpdate(Request $request, $id){
        $request->validate([
            'status' => 'required|in:pending,approved,expired',
        ]);

        $subscription = Subscription::findOrFail($id);
        $subscription->status = $request->status;
        $subscription->save();

        if($request->status === 'approved'){
            $user = $subscription->user;
            $plan = $subscription->plan;

            $user->credits =  ($user->credits ?? 0) + $plan->characters;
            $user->current_plan_id = $plan->id;
            $user->plan_name = $plan->name;

            $durationDays = (int) $plan->duration; // convert to integer
            $user->plan_expiry_date = \Carbon\Carbon::parse(
                $user->plan_expiry_date ?? now()
            )->addDays($durationDays)->endOfDay();

            // $user->plan_expiry_date = now()->addDays($durationDays)->endOfDay();

            $user->save();
        }

        return redirect()->back()->with('success', 'Subscription status updated successfully.');
    }

    public function deleteProofPlan($id){
        $subscription = Subscription::find($id);
        if (!$subscription) {
            return redirect()->back()->with('error', 'Subscription not found.');
        }
        $subscription->delete();
        return redirect()->back()->with('success', 'Subscription deleted successfully.');
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

    $start = now();
    $end = now()->addDays((int) $plan->duration)->endOfDay();

    // Insert into subscriptions table
    Subscription::create([
        'user_id' => $user->user_id,
        'plan_id' => $plan->id,
        'payment_method' => 'free',
        'amount' => 0,
        'currency' => 'USD',
        'start_date' => $start,
        'end_date' => $end,
        'status' => 'approved'
    ]);

        return redirect('/index')->with('success', 'Free plan activated successfully!');
    }

}
