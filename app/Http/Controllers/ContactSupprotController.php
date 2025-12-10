<?php

namespace App\Http\Controllers;

use App\Models\ContactSupport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactSupprotController extends Controller
{
    public function contactSupport(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'full_name'    => 'required|string|max:255',
            'last_name'    => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'email'        => 'required|email|max:255',
            'message'      => 'required|string',
        ]);

        $support = new ContactSupport();
        $support->user_id = Auth::check() ? Auth::id() : null;
        $support->first_name = $validated['full_name'];  // your choice
        $support->last_name = $validated['last_name'];
        $support->phone_number = $validated['phone_number'];
        $support->email = $validated['email'];
        $support->message = $validated['message'];
        $support->save();

        return response()->json([
            'status' => 1,
            'msg' => 'Your support request has been submitted successfully.']);
    }


    public function showSupportPage()
    {
        $messages = ContactSupport::latest()->get();

        return view('pages.supportNotification', compact('messages'));
    }

//     public function getSupportMessages(){
//     $messages = ContactSupport::latest()->get();

//     $html = '';
//     if($messages->count() > 0){
//         foreach($messages as $msg){
//             $html .= '<div class="border rounded p-3 mb-3">';
//             $html .= '<strong>'.$msg->first_name.' '.$msg->last_name.'</strong><br>';
//             $html .= '<small>Email: '.$msg->email.'</small><br>';
//             $html .= '<small>Phone: '.$msg->phone_number.'</small>';
//             $html .= '<p class="mt-2">'.$msg->message.'</p>';
//             $html .= '<small class="text-muted">'.$msg->created_at->diffForHumans().'</small>';
//             $html .= '</div>';
//         }
//     } else {
//         $html = '<p>No support messages found.</p>';
//     }

//     return response()->json(['html' => $html]);
// }


}
