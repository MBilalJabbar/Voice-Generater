<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    public function redirectToGoogle(Request $request)
    {
        // For local testing, use stateless() if you got InvalidStateException
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $findUser = User::where('google_id', $googleUser->id)->first();

        if ($findUser) {
            Auth::login($findUser);
            return redirect()->route('dashboard.index');
        } else {
            $newUser = User::create([
                'full_name' => $googleUser->name ?? 'Unknown User',
                'user_name' => $googleUser->email ? explode('@', $googleUser->email)[0] : 'user_'.uniqid(),
                'email' => $googleUser->email,
                'google_id' => $googleUser->id,
                'profile_picture' => $googleUser->avatar,
                'password' => bcrypt(Str::random(16)),
            ]);


            Auth::login($newUser);
            return redirect()->route('dashboard.index');
        }
    }
}
