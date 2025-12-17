<?php
namespace App\Http\View\Composers;

use App\Models\CreditHistory;
use Illuminate\View\View;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class SubscriptionComposer
{
    // public function compose(View $view)
    // {
    //     $subscription = null;

    //     if (Auth::check()) {
    //         $subscription = Subscription::where('user_id', Auth::id())
    //             ->where('status', 'approved')
    //             ->with('user')
    //             ->first();
    //     }


    //     $view->with('headerSubscription', $subscription);
    // }





    public function compose(View $view)
    {
        // --- Subscription for logged-in user ---
        // $headerSubscription = null;
        // if (Auth::check()) {
        //     $headerSubscription = Subscription::where('user_id', Auth::id())
        //         ->where('status', 'approved')
        //         ->with('user')
        //         ->first();
        // }

        $headerSubscription = null;
        $availableCredits = 0;
        $nearestExpiry = null;

        if (Auth::check()) {

            //  Latest approved subscription (for IF condition)
            $headerSubscription = Subscription::where('user_id', Auth::id())
                ->where('status', 'approved')
                ->latest()
                ->first();

            //  GenAI-style credits
            $creditRows = CreditHistory::where('user_id', Auth::id())
                ->where('status', 'available')
                ->where('remaining_credits', '>', 0)
                ->orderBy('expiry_date', 'asc')
                ->get();

            $availableCredits = $creditRows->sum('remaining_credits');
            $nearestExpiry = $creditRows->first()?->expiry_date;
        }

        // --- GenAI Credit Details ---


        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('GENAIPRO_API_KEY'),
            'Accept' => 'application/json',
        ])->get('https://genaipro.vn/api/v1/me');

        $username = $balance = $totalCredits = $nextExpire = null;
        $credits = [];

        if ($response->successful()) {
            $data = $response->json();
            $username = $data['username'] ?? 'N/A';
            $balance = $data['balance'] ?? 0;
            $credits = $data['credits'] ?? [];
            $totalCredits = array_sum(array_column($credits, 'amount'));
            $nextExpire = $credits[0]['expire_at'] ?? null;
        }

        // --- Share with view ---
        $view->with(compact(
            'headerSubscription',
            'availableCredits',
            'nearestExpiry',
            'username',           // GenAI username
            'balance',            // GenAI balance
            'totalCredits',       // total GenAI credits
            'credits',            // all GenAI credits
            'nextExpire'          // next expiration
        ));
    }


}
