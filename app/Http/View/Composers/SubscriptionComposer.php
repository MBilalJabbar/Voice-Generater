<?php
namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;

class SubscriptionComposer
{
    public function compose(View $view)
    {
        $subscription = null;

        if (Auth::check()) {
            $subscription = Subscription::where('user_id', Auth::id())
                ->where('status', 'approved')
                ->with('user')
                ->first();
        }


        $view->with('headerSubscription', $subscription);
    }
}
