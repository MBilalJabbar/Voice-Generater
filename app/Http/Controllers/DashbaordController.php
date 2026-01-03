<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\TaskHistory;
use App\Models\VoiceGenerate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DashbaordController extends Controller
{
    public function index(Request $request)
    {
        $voices = VoiceGenerate::with('user')
                        ->where('user_id', Auth::id())
                        ->orderBy('created_at', 'Desc')
                        ->get();
        $plaStatus = Subscription::where('user_id', Auth::id())
        ->latest('created_at')->first();
        return view('dashboard.index', compact('voices', 'plaStatus'));
    }

    // Voices Show view button popup in DataTable
    public function fetchVoices($id){
        $voice = VoiceGenerate::where('id', $id)->first();
        if (!$voice) {
            return response()->json(['success' => false, 'message' => 'Voice not found'], 404);
        }
        return response()->json(['success'=> true, 'data'=> $voice]);
    }

    public function deletedVoice($id){
        $voice = VoiceGenerate::where('id', $id)->first();
        if($voice->audio_path && Storage::exists($voice->audio_path)){
            Storage::delete($voice->audio_path);
        }
        TaskHistory::create([
            'user_id' => Auth::id(),
            'voice_id' => $voice->id,
            'voice_name' => $voice->voice_name,
            'text' => $voice->text,
            'language' => $voice->language,
            'model' => $voice->model,
            'status' => 'deleted',
            'voice_settings' => $voice->voice_settings,
            'audio_path' => $voice->audio_path,
            'deleted_at' => now(),
        ]);
        $voice->delete();
        return response()->json(['message' => 'Voice deleted successfully'], 200);

        // if($voice){
        //     $voice->delete();
        //     return response()->json(['message' => 'Voice deleted successfully'], 200);
        // } else {
        //     return response()->json(['message' => 'Voice not found'], 404);
        // }
    }
}
