<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\LoginNotificationMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function CreateUser(Request $request){
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'user_name' => 'required|string|max:255|unique:users,user_name',
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|string|min:8|confirmed',
            'google_id' => 'nullable|string|max:255',
            'profile_picture' => 'nullable|image|max:2048',
        ]);
        $userData = new User();
        $userData->full_name = $validatedData['full_name'];
        $userData->user_name = $validatedData['user_name'];
        $userData->email = $validatedData['email'];
        $userData->phone = $validatedData['phone'] ?? null;
        $userData->password = bcrypt($validatedData['password']);
        $userData->google_id = $validatedData['google_id'] ?? null;
        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $userData->profile_picture = $path;
        }
        $userData->save();

        return response()->json(['message' => 'User created successfully', 'user' => $userData], 201);
    }

  public function LoginUser(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string',
    ]);

    if (Auth::attempt($credentials)) {
        // Send mail to the user
        Mail::to(Auth::user()->email)->send(new LoginNotificationMail(Auth::user()));
        // Send mail to all admins
        $admin = User::where('user_role', 'admin')->get();
        foreach ($admin as $admins){
            Mail::to($admins->email)->send(new LoginNotificationMail(Auth::user()));
        }
        if (Auth::user()->user_role == 'admin' || Auth::user()->user_role == 'manager'){
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard.index');
        }else{
            $request->session()->regenerate();
            return redirect()->route('dashboard.index');
        }
    }

    // Login failed — show error message or redirect back
    return back()->withErrors([
        'email' => 'Invalid credentials. Please try again.',
    ]);
}


    public function LogoutUser (Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
        // return response()->json(['message' => 'Logout successful'], 200);
    }

    // Password Reset functions
    public function sendForgotPasswordLink(Request $request){
        $validateData = $request->validate([
            'email'=> 'required|string|email|exists:users,email',
        ]);
        $token = Str::random(60);
        DB::table('password_reset_tokens')->updateOrInsert([
            'email' => $validateData['email'],
            'token' => $token,
            'created_at' => now(),
        ]);
        Mail::raw('Click the link to reset your password: ' . url('/reset-password?token=' . $token . '&email=' . urlencode($validateData['email'])), function ($message) use ($validateData) {
            $message->to($validateData['email']);
            $message->subject('Password Reset Link');
        });
        return redirect()->back()->with(['message' => 'Password reset link sent to your email.'], 200);
    }

    public function submitConfirmPassword(Request $request){
        $request->validate([
            'email'=> 'required|string|email|exists:users,email',
            'password'=> 'required|string|min:8|confirmed',
            'password_confirmation'=> 'required|string|min:8',
        ]);
        $updatePassword = DB::table('password_reset_tokens')
            ->where([
                'email' => $request->email,
                'token' => $request->token,
            ])->first();
        $userTable = User::where('email', $request->email)->update([
            'password' => bcrypt($request->password),
        ]);
        DB::table('password_reset_tokens')->where(['email' => $request->email])->delete();
        return redirect('/login')->with(['message' => 'Password updated successfully. You can now login with your new password.'], 200);
    }
}
