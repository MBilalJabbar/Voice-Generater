<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AddUserAdminController extends Controller
{
    public function CreateUserAdminPage(){
        return view('admin.adduser.create');
    }
    public function CreateUserAdmin(Request $request){
        $request->validate([
            'full_name' => 'required|string|max:255',
            'user_name'=> 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'nullable|string|min:8',
            'user_type' => 'required|string|in:admin,manager,user',
            'phone' => 'required|string',
            'profileImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $imagePath = null;
        if($request->hasFile('profileImage')){
            $image = $request->file('profileImage');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/profiles'), $imageName);
            $imagePath = 'images/profiles/' . $imageName;
        }
        User::create([
            'user_name'       => $request->user_name,
            'full_name'  => $request->full_name,
            'email'      => $request->email,
            'user_type'  => $request->user_type,
            'profile_picture' => $imagePath,
            'phone' => $request->phone,
            'password'   => Hash::make($request->password),
            'added_user_id' => Auth::id(),
        ]);
        return view('admin.adduser.create');
        // return redirect()->back()->with('success', 'User added successfully.');
    }
    public function index(Request $request)
    {
        $users = User::all();
        // $users = User::whereIn('user_role', ['admin', 'manager'])->get();
        return view('admin.adduser.index', compact('users'));
    }

    public function editUserAdmin($id){
        $user = User::find($id);
        return view('admin.adduser.edit', compact('user'));
    }
    public function updateUserAdmin(Request $request, $id)
{
    $request->validate([
        'full_name' => 'required|string|max:255',
        'user_name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id . ',user_id',
        'password' => 'nullable|string|min:8',
        'user_role' => 'required|string|in:admin,manager,user',
        'phone' => 'required|string',
        'profileImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $user = User::findOrFail($id);

    $user->full_name = $request->full_name;
    $user->user_name = $request->user_name;
    $user->email = $request->email;
    $user->user_role = $request->user_role;
    $user->phone = $request->phone;

    if ($request->password) {
        $user->password = Hash::make($request->password);
    }

    if ($request->hasFile('profileImage')) {
        // Delete old image if exists
        if ($user->profile_picture && file_exists(public_path($user->profile_picture))) {
            unlink(public_path($user->profile_picture));
        }

        $image = $request->file('profileImage');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/profiles'), $imageName);
        $user->profile_picture = 'images/profiles/' . $imageName;
    }

    $user->save();

    return redirect()->back()->with('success', 'User updated successfully.');
}

public function deleteUserAdmin($id)
{
    $user = User::findOrFail($id);

    // Delete image if exists
    if ($user->profile_picture && file_exists(public_path($user->profile_picture))) {
        unlink(public_path($user->profile_picture));
    }

    $user->delete();

    return redirect()->back()->with('success', 'User deleted successfully.');
}
public function ShowUserAdminDetails($id)
{
    $user = User::find($id);
    if (!$user) {
        return response()->json(['success' => false, 'message' => 'User not found']);
    }
    return response()->json(['success' => true, 'data' => $user]);
}



}
