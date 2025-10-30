<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\VoicesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::where('user_role', 'user')
                        ->orderBy('created_at', 'Desc')
                        ->take(5)
                        ->get();
        $userCount = $users->count();

        return view('admin.dashboard.index', compact('users', 'userCount'));
    }

    public function payment()
    {
        return view('admin.payment.index');
    }

    public function plansIndex()
    {
        return view('admin.plans.index');
    }

     public function plansCreate()
    {
        return view('admin.plans.create');
    }

     public function plansEdit()
    {
        return view('admin.plans.edit');
    }


    // Add Voices From Admin Dashboard
    public function createVoices(Request $request){
        $request->validate([
            'title' => 'required|string',
            'audio' => 'required|file|mimes:mp3,wav,ogg',
            'note' => 'nullable|string',
        ]);
        $fileName = time() . '.' . $request->audio->extension();
        $request->audio->move(public_path('voices'), $fileName);
        VoicesModel::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'audio_path' => 'voices/' . $fileName,
            'note' => $request->note,
        ]);
        return response()->json(['success' => true, 'message' => 'Voice Save successfully.']);


    }
     public function addvoices()
    {
        $voices = VoicesModel::all();
        return view('admin.voices.index', compact('voices'));
    }
    public function editVoice(Request $request, $id){
        $voice = VoicesModel::find($id);
        $request->validate([
            'title' => 'required|string',
            'audio' => 'nullable|file|mimes:mp3,wav,ogg',
            'note' => 'nullable|string',
        ]);
        $voice->title = $request->title;
        $voice->note = $request->note;
         if ($request->hasFile('audio')) {
        $fileName = time() . '.' . $request->audio->extension();
        $request->audio->move(public_path('voices'), $fileName);
        $voice->audio_path = 'voices/' . $fileName;
    }

        $voice->save();
        return response()->json(['success' => true, 'message' => 'Voice updated successfully.']);
    }

    public function deleteVoice($id){
        $voice = VoicesModel::find($id);
        $voice->delete();
        return response()->json(['success' => true, 'message' => 'Voice deleted successfully.']);
    }
}
