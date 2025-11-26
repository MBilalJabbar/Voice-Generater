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
        // $VoiceClone = VoiceClone::all();
        $VoiceClone = VoiceClone::where('user_id', Auth::id())->get();
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

        //  Store uploaded file temporarily
        $path = $request->file('voice_file')->store('voices', 'public');
        $fileFullPath = storage_path("app/public/" . $path);

        try {
            //  Send to GenAI Pro API first
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.genai_pro.key'),
            ])->attach(
                'audio_file',
                file_get_contents($fileFullPath),
                basename($fileFullPath)
            )->post('https://genaipro.vn/api/v1/max/voice-clones', [
                'voice_name' => $request->name,
                'preview_text' => $request->sample_text ?? 'Default preview text',
                'language_tag' => 'Vietnamese',
                'need_noise_reduction' => $request->noise_reduction ?? false,
            ]);

            //  Check if API failed
            if ($response->failed()) {
                return back()->with('error', 'Voice cloning failed: ' . $response->body());
            }

            $data = $response->json();

            //  Check if valid response
            if (!isset($data['id']) || empty($data['id'])) {
                return back()->with('error', 'Invalid API response: ' . json_encode($data));
            }

            //  If successful, store in DB
            $voice = VoiceClone::create([
                'user_id' => Auth::id(),
                'name' => $request->name,
                'sample_text' => $request->sample_text,
                'language' => 'Vietnamese',
                'gender' => null,
                'voice_id' => $data['id'] ?? uniqid('voice_'),
                'file_path' => $path,
                'noise_reduction' => $request->noise_reduction,
                'status' => ($data['voice_status'] == 2) ? 'ready' : 'pending',
            ]);

            return back()->with('success', 'Voice cloned and saved successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function cloneVoiceDelete($id){
        $cloneVoice = VoiceClone::find($id);
        if($cloneVoice){
            $cloneVoice->delete();
            return response()->json(['success'=>true, 'message'=> 'Voice Deleted Successfully']);
        }
    }

// public function getCloneVoices()
// {
//     try {
//         \Log::info('🔍 Fetching cloned voices from GenAI Pro...');

//         // ✅ Get API key consistently from config/services.php
//         $apiKey = config('services.genai_pro.key');

//         if (empty($apiKey)) {
//             \Log::error('❌ Missing GENAIPRO_API_KEY in environment');
//             return response()->json([
//                 'error' => 'API configuration error',
//                 'message' => 'API key not configured'
//             ], 500);
//         }

//         // ✅ Make API request (removed trailing slash)
//         $response = Http::withHeaders([
//             'Authorization' => 'Bearer ' . $apiKey,
//             'Accept'        => 'application/json',
//             'Content-Type'  => 'application/json',
//         ])
//         ->timeout(30)
//         ->retry(3, 200)
//         ->get('https://genaipro.vn/api/v1/max/voice-clones');

//         \Log::info('🌐 API Response Status: ' . $response->status());
//         \Log::info('🌐 API Response Body: ' . $response->body());

//         // ✅ Handle failed responses
//         if ($response->failed()) {
//             \Log::error('❌ API request failed', [
//                 'status'  => $response->status(),
//                 'body'    => $response->body(),
//                 'headers' => $response->headers()
//             ]);

//             return response()->json([
//                 'error'   => 'API request failed',
//                 'status'  => $response->status(),
//                 'message' => $response->body(),
//             ], 500);
//         }

//         // ✅ Decode JSON safely
//         $data = $response->json();

//         if (empty($data)) {
//             \Log::warning('⚠️ Empty response from clone voices API');
//             return response()->json([
//                 'voices'  => [],
//                 'message' => 'No clone voices found'
//             ]);
//         }

//         // ✅ Handle possible data structures
//         $voices = [];

//         if (isset($data['data']) && is_array($data['data'])) {
//             $voices = $data['data'];
//         } elseif (isset($data['voices']) && is_array($data['voices'])) {
//             $voices = $data['voices'];
//         } elseif (is_array($data)) {
//             $voices = $data;
//         }

//         \Log::info('✅ Voices extracted: ' . count($voices));

//         // ✅ Format results consistently
//         $formattedVoices = array_map(function ($voice) {
//             return [
//                 'voice_id'    => $voice['voice_id'] ?? $voice['id'] ?? null,
//                 'name'        => $voice['voice_name'] ?? 'Unnamed Clone Voice',
//                 'category'    => $voice['category'] ?? 'Clone Voice',
//                 'avatar_url'  => $voice['avatar_url'] ?? $voice['avatar'] ?? null,
//                 'preview_url' => $voice['preview_url'] ?? $voice['preview'] ?? null,
//                 'description' => $voice['description'] ?? null,
//             ];
//         }, $voices);

//         return response()->json([
//             'voices' => $formattedVoices,
//             'count'  => count($formattedVoices)
//         ]);

//     } catch (\Exception $e) {
//         \Log::error('💥 Exception in getCloneVoices: ' . $e->getMessage(), [
//             'file'  => $e->getFile(),
//             'line'  => $e->getLine(),
//             'trace' => $e->getTraceAsString(),
//         ]);

//         return response()->json([
//             'error'   => 'Internal server error',
//             'message' => $e->getMessage(),
//         ], 500);
//     }
// }



public function getCloneVoices()
{
    try {
        \Log::info('🔍 Fetching cloned voices from GenAI Pro...');

        $apiKey = config('services.genai_pro.key');

        if (empty($apiKey)) {
            \Log::error('❌ Missing GenAI Pro API key');
            return response()->json([
                'error' => 'API configuration error',
                'message' => 'API key not configured'
            ], 500);
        }

        \Log::info('✅ API Key found: ' . substr($apiKey, 0, 10) . '...');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
            'Accept'        => 'application/json',
        ])
        ->timeout(30)
        ->retry(3, 200)
        ->get('https://genaipro.vn/api/v1/max/voice-clones');

        \Log::info('🌐 API Response Status: ' . $response->status());

        if ($response->failed()) {
            \Log::error('❌ API request failed', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            return response()->json([
                'error' => 'API request failed',
                'status' => $response->status(),
                'message' => 'Failed to fetch voices from API',
            ], 500);
        }

        $data = $response->json();
        \Log::info('📊 Full API Response:', $data);

        // ✅ Handle the specific GenAI Pro response structure
        $voices = [];

        if (isset($data['voice_clones']) && is_array($data['voice_clones'])) {
            $voices = $data['voice_clones'];
            \Log::info('✅ Using voice_clones structure with ' . count($voices) . ' voices');
        } elseif (isset($data['data']) && is_array($data['data'])) {
            $voices = $data['data'];
            \Log::info('✅ Using data structure with ' . count($voices) . ' voices');
        }

        \Log::info('🎯 Final voices count: ' . count($voices));

        if (empty($voices)) {
            \Log::warning('⚠️ No voices found in API response');
            return response()->json([
                'voices' => [],
                'message' => 'No clone voices available in your account',
                'debug' => [
                    'response_keys' => array_keys($data),
                    'has_voice_clones' => isset($data['voice_clones']),
                    'total_in_response' => $data['total'] ?? 0
                ]
            ]);
        }

        // ✅ Format the voices for frontend
        $formattedVoices = array_map(function ($voice) {
            \Log::info('🎵 Processing voice:', $voice);

            // Handle avatar/cover image
            $avatarUrl = $voice['cover_url'] ?? $voice['avatar_url'] ?? $voice['image_url'] ?? null;

            // Handle preview audio - GenAI Pro might use 'sample_audio' or you might need to generate a preview
            $previewUrl = $voice['sample_audio'] ?? $voice['preview_url'] ?? $voice['audio_url'] ?? null;

            // If no preview URL exists, you might want to generate one using text-to-speech
            // or use a default preview based on the voice
            if (empty($previewUrl)) {
                // You can create a preview using the preview_text with TTS
                $previewText = $voice['preview_text'] ?? 'Hello, this is a voice preview';
                // Note: You might need to call a TTS endpoint here to generate audio
                \Log::info('No sample audio available for voice: ' . $voice['voice_name']);
            }

            return [
                'id' => $voice['id'] ?? $voice['voice_id'] ?? uniqid(),
                'voice_id' => $voice['voice_id'] ?? $voice['id'] ?? '',
                'name' => $voice['voice_name'] ?? $voice['name'] ?? 'Unnamed Voice',
                'category' => 'Clone Voice',
                'avatar_url' => $avatarUrl,
                'preview_url' => $previewUrl,
                'description' => $voice['description'] ?? '',
                'status' => $voice['voice_status'] ?? 0,
                'tags' => $voice['tag_list'] ?? [],
                'preview_text' => $voice['preview_text'] ?? '',
                'created_at' => $voice['create_time'] ?? 0,
                'updated_at' => $voice['update_time'] ?? 0,
            ];
        }, $voices);

        return response()->json([
            'voices' => $formattedVoices,
            'count' => count($formattedVoices),
            'total' => $data['total'] ?? count($formattedVoices),
            'success' => true
        ]);

    } catch (\Exception $e) {
        \Log::error('💥 Exception in getCloneVoices: ' . $e->getMessage(), [
            'file' => $e->getFile(),
            'line' => $e->getLine()
        ]);

        return response()->json([
            'error' => 'Internal server error',
            'message' => $e->getMessage(),
            'success' => false
        ], 500);
    }
}

}
