<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\UserSchedule; // Make sure this is imported

class AddUserController extends Controller
{
    // Retrieve all users and pass them to the adduser index blade view
    public function index(Request $request)
    {
        $users = User::all();
        // $users = User::whereIn('user_role', ['admin', 'manager'])->get();
        return view('admin.adduser.index', compact('users'));
    }

    // Return the create user form where admin can input user details
    public function create()
    {
        return view('admin.adduser.create');
    }

    // Validate and store new user details including hashed password into database

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'nullable|string|min:8',
            'user_type' => 'required|string|in:admin,manager,user',
        ]);


        // Create user
        User::create([
            'user_name'       => $request->name,
            'email'      => $request->email,
            'user_type'  => $request->user_type,
            'password'   => Hash::make($request->password),
            'added_user_id' => Auth::id(),
        ]);


        return redirect()->route('adduser.create')->with('success', 'User added successfully.');
    }


    // Fetch user by ID and show it in the edit form for updating
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.adduser.edit', compact('user'));
    }

    // Validate and update the user details including optional password update
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
            'user_type' => 'required|string|in:admin,manager',
        ]);


        $user = User::findOrFail($id);

        $user->user_name = $request->name;
        $user->email = $request->email;
        $user->user_type = $request->user_type;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.adduser.index')->with('success', 'User updated successfully.');
    }


    // Find the user by ID and delete the user from the database
    public function destroy($id)
    {
        $adduser = User::findOrFail($id);
        $adduser->delete();

        return redirect()->route('admin.adduser.index')->with('success', 'User deleted successfully.');
    }

}
