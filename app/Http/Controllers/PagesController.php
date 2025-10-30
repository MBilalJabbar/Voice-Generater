<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function contact()
    {
        return view('pages.contact');
    }

    public function setting()
    {
        $user = Auth::user();
        return view('pages.setting', compact('user'));
    }
    public function UpdateSetting(Request $request){
    $user = Auth::user();

    $validatedData = $request->validate([
        'full_name' => 'required|string|max:255',
        'user_name' => 'required|string|max:255|unique:users,user_name,' . $user->user_id . ',user_id',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->user_id . ',user_id',
        'phone' => 'nullable|string|max:20',
        'password' => 'nullable|string|min:8|confirmed',
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Handle profile picture upload
    if ($request->hasFile('profile_picture')) {
        $image = $request->file('profile_picture');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/profiles'), $imageName);
        $user->profile_picture = 'images/profiles/' . $imageName;
    }

    // Handle password hashing if provided
    if (!empty($request->password)) {
        $user->password = bcrypt($request->password);
    }

    // Update other fields
    $user->full_name = $validatedData['full_name'];
    $user->user_name = $validatedData['user_name'];
    $user->email = $validatedData['email'];
    $user->phone = $validatedData['phone'] ?? $user->phone;

    $user->save();

    return redirect()->back()->with('success', 'Profile updated successfully.');
}


    public function profile()
    {
        $user = Auth::user();
        return view('pages.profile', compact('user'));
    }
}

