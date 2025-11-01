<?php

namespace App\Http\Controllers;

use App\Models\VoiceClone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CloneVoiceController extends Controller
{
    public function index()
    {
        return view('clonevoice.index');
    }
    public function addVoiceClone(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'voice_file' => 'required|file|mimes:mp3,wav,m4a|max:10240',
            'sample_text' => 'nullable|string|max:500',
            'noise_reduction' => 'nullable|boolean',
        ]);

        $path = $request->file('voice_file')->store('voices', 'public');

        VoiceClone::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'sample_text' => $request->sample_text,
            'language' => 'English',
            'gender' => null,
            'voice_id' => uniqid('voice_'),
            'file_path' => $path,
            'noise_reduction' => $request->noise_reduction,
        ]);

        return back()->with('success', 'Voice uploaded successfully! Ready for cloning.');
    }


}
