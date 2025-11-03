<?php

namespace App\Http\Controllers;

use App\Models\VoiceClone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class CloneVoiceController extends Controller
{
    public function index()
    {
        $VoiceClone = VoiceClone::all();
        return view('clonevoice.index', compact('VoiceClone'));
    }
//     public function addVoiceClone(Request $request){
//         $request->validate([
//             'name' => 'required|string|max:255',
//             'voice_file' => 'required|file|mimes:mp3,wav,m4a|max:10240',
//             'sample_text' => 'nullable|string|max:500',
//             'noise_reduction' => 'nullable|boolean',
//         ]);

//         $path = $request->file('voice_file')->store('voices', 'public');

//         $voice = VoiceClone::create([
//             'user_id' => Auth::id(),
//             'name' => $request->name,
//             'sample_text' => $request->sample_text,
//             'language' => 'English',
//             'gender' => null,
//             'voice_id' => uniqid('voice_'),
//             'file_path' => $path,
//             'noise_reduction' => $request->noise_reduction,
//             'status' => 'pending',
//         ]);

//         // ✅ Send file to GenAI Pro API
//         $response = Http::withHeaders([
//     'x-api-key' => config('services.genai_pro.key'),
// ])->attach(
//     'file', file_get_contents(storage_path("app/public/".$path)), basename($path)
// )->post('https://genaipro.vn/api/v1/max/voice-clones', [
//     'voice_name' => $request->name,
//     'sample_text' => $request->sample_text,
//     'noise_reduction' => $request->noise_reduction ?? false,
// ]);




//         if ($response->failed()) {
//             $voice->update(['status' => 'failed']);
//             return back()->with('error', 'Voice cloning failed: '.$response->body());
//         }

//         $data = $response->json();

//         if (!isset($data['voice_id'])) {
//             $voice->update(['status' => 'failed']);
//             return back()->with('error', 'Invalid API response');
//         }

//         $voice->update([
//             'voice_id' => $data['voice_id'],
//             'status'   => 'ready',
//         ]);

//         return back()->with('success', 'Voice uploaded and cloned successfully!');
//     }



public function addVoiceClone(Request $request){
    $request->validate([
        'name' => 'required|string|max:255',
        'voice_file' => 'required|file|mimes:mp3,wav,m4a|max:10240',
        'sample_text' => 'nullable|string|max:500',
        'noise_reduction' => 'nullable|boolean',
    ]);

    $path = $request->file('voice_file')->store('voices', 'public');

    $voice = VoiceClone::create([
        'user_id' => Auth::id(),
        'name' => $request->name,
        'sample_text' => $request->sample_text,
        'language' => 'Vietnamese', // Changed to match API
        'gender' => null,
        'voice_id' => uniqid('voice_'),
        'file_path' => $path,
        'noise_reduction' => $request->noise_reduction,
        'status' => 'pending',
    ]);

    // ✅ Send file to GenAI Pro API (Corrected version)
    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . config('services.genai_pro.key'), // Use Bearer token
    ])->attach(
        'audio_file', // API expects 'audio_file' not 'file'
        file_get_contents(storage_path("app/public/".$path)),
        basename($path)
    )->post('https://genaipro.vn/api/v1/max/voice-clones', [
        'voice_name' => $request->name,
        'preview_text' => $request->sample_text, // API expects 'preview_text'
        'language_tag' => 'Vietnamese', // Required by API
        'need_noise_reduction' => $request->noise_reduction ?? false, // API expects 'need_noise_reduction'
    ]);

    if ($response->failed()) {
        $voice->update(['status' => 'failed']);
        return back()->with('error', 'Voice cloning failed: '.$response->body());
    }

    $data = $response->json();

    if (!isset($data['voice_id'])) {
        $voice->update(['status' => 'failed']);
        return back()->with('error', 'Invalid API response: ' . json_encode($data));
    }

    $voice->update([
        'voice_id' => $data['voice_id'],
        'status'   => 'ready',
    ]);

    return back()->with('success', 'Voice uploaded and cloned successfully!');
}
    public function cloneVoiceDelete($id){
        $cloneVoice = VoiceClone::find($id);
        if($cloneVoice){
            $cloneVoice->delete();
            return response()->json(['success'=>true, 'message'=> 'Voice Deleted Successfully']);
        }
    }

}
