<?php

namespace App\Http\Controllers;

use App\Models\CreditHistory;
use App\Models\Subscription;
use App\Models\VoiceGenerate;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class VoiceGeneratorController extends Controller
{
    // public function fetchVoices() {
    //     $apiKey = env('ELEVENLABS_API_KEY');
    //     $response = Http::withHeaders([
    //         'xi-api-key' => $apiKey, ])->get('https://api.elevenlabs.io/v1/voices');

    //     return response()->json(json_decode($response->body(), true));
    // }

public function fetchGenAIVoices(Request $request)
{
    $search = $request->query('search', '');
    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . env('GENAIPRO_API_KEY'),
    ])->get('https://genaipro.vn/api/v1/labs/voices',[
        'page'       => 0,
        'page_size'  => 100,
        'sort'       => 'trending',
        'search' => $search,
    ]);

    if ($response->failed()) {
        return response()->json(['error' => 'Failed to connect or invalid API key'], 500);
    }

    $data = $response->json();

    // Check response format
    if (empty($data)) {
        return response()->json(['error' => 'No voices found or expired account'], 404);
    }

    return response()->json($data);
}

    // public function generateAudioVoice(Request $request) {
    //     $apiKey = env('ELEVENLABS_API_KEY');
    //     $voiceId = $request->voice_id ?? '21m00Tcm4TlvDq8ikWAM'; // default voice
    //     $text = $request->text; // ensure text exists
    //         if (!$text) {
    //             return response()->json(['success' => false, 'message' => 'No text provided']);
    //         }
    //         // make ElevenLabs request
    //         $response = Http::withHeaders([
    //             'xi-api-key' => $apiKey,
    //             'Accept' => 'audio/mpeg', // important!
    //         ])->post("https://api.elevenlabs.io/v1/text-to-speech/$voiceId", [
    //                 "text" => $text,
    //                 "model_id" => "eleven_multilingual_v2",
    //                 "voice_settings" => [
    //                     "stability" => (float)($request->stability ?? 0.5),
    //                     "similarity_boost" => (float)($request->similarity ?? 0.5),
    //                     "style" => (float)($request->style ?? 0.5),
    //                     "speed" => (float)($request->speed ?? 1.0), ]
    //                 ]);
    //                      // handle response
    //                     if ($response->ok()) { // ensure folder exists
    //                         if (!file_exists(public_path('generated'))) {
    //                              mkdir(public_path('generated'), 0777, true); }
    //                              // save file
    //                         $fileName = 'voice_' . time() . '.mp3';
    //                         $path = public_path('generated/' . $fileName);
    //                         file_put_contents($path, $response->body());
    //                         $voice = new VoiceGenerate();
    //                         $voice->user_id = Auth::check() ? Auth::id() : null;
    //                         $voice->voice_name = $request->voice_name ?? 'Generated Voice';
    //                         $voice->text = $request->text ?? null;
    //                         $voice->language = $request->language ?? 'en-US';
    //                         $voice->model = $request->model ?? 'eleven_multilingual_v2';
    //                         $voice->voice_settings = json_encode([
    //                             "stability" => (float)($request->stability ?? 0.5),
    //                             "similarity_boost" => (float)($request->similarity ?? 0.5),
    //                             "style" => (float)($request->style ?? 0.5),
    //                             "speed" => (float)($request->speed ?? 1.0), ]);
    //                         $voice->api_voice_id = $voiceId;
    //                         $voice->audio_path = 'generated/' . $fileName;
    //                         $voice->status = 'progress';
    //                         $voice->started_time = Carbon::now();
    //                         $voice->save();

    //                         try{
    //                             $voice->status = 'completed';
    //                             $voice->completed_time = Carbon::now();
    //                             $voice->save();
    //                         }catch(\Exception $e){
    //                             $voice->status = 'failed';
    //                             $voice->save();
    //                         } return response()->json([
    //                             'success' => true,
    //                             'audio_url' => asset('generated/' . $fileName),
    //                             'voice' => $voice ]);
    //                         } // error response
    //                         return response()->json([
    //                             'success' => false,
    //                             'message' => 'Voice generation failed',
    //                             'details' => $response->json(),
    //                         ], $response->status());
    // }

    // give me late response but work good function
public function generateAudioVoices(Request $request){
    $request->validate([
        'text' => 'required|string',
        'voice_id' => 'nullable|string',
        'voice_name' => 'nullable|string',
    ]);
    $apiKey = env('GENAIPRO_API_KEY');
    $voiceId = $request->voice_id ?? 'uju3wxzG5OhpWcoi3SMy';
    $text = $request->text;

    if (!$text) {
        return response()->json(['success' => false, 'message' => 'No text provided']);
    }
    $user = Auth::user();
    $requiredCredits = mb_strlen($text);

    $today = Carbon::today();
    $availableCredits = CreditHistory::where('user_id', $user->user_id)
        ->where('status', 'available')
        ->where('expiry_date', '>=', $today)
        ->where('remaining_credits', '>', 0)
        ->sum('remaining_credits');

    if ($availableCredits < $requiredCredits) {
        return response()->json([
            'success' => false,
            'message' => 'Insufficient credits. Please upgrade your plan.'
        ]);
    }

    // ✅ AFTER audio is successfully generated
    $creditRows = CreditHistory::where('user_id', $user->user_id)
        ->where('status', 'available')
        ->where('remaining_credits', '>', 0)
        ->orderBy('expiry_date', 'asc')
        ->get();

    $remaining = $requiredCredits;

    foreach ($creditRows as $credit) {
        if ($remaining <= 0) break;

        $use = min($credit->remaining_credits, $remaining);
        $credit->remaining_credits -= $use;
        $credit->save();

        $remaining -= $use;
    }

    try {

        // ✅ 1. Create Task
        $taskResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
        ])->post('https://genaipro.vn/api/v1/labs/task', [
            "input" => $text,
            "voice_id" => $voiceId,
            "model_id" => "eleven_multilingual_v2",
            "style" => (float)($request->style ?? 0.5),
            "speed" => (float)($request->speed ?? 1.0),
            "similarity" => (float)($request->similarity ?? 0.75),
            "stability" => (float)($request->stability ?? 0.5),
            "use_speaker_boost" => true
        ]);

        if (!$taskResponse->ok()) {
            return response()->json([
                'success' => false,
                'message' => 'Task creation failed',
                'details' => $taskResponse->body()
            ]);
        }

        $taskId = $taskResponse->json()['task_id'] ?? null;

        if (!$taskId) {
            return response()->json(['success' => false, 'message' => 'Task ID missing']);
        }


        // ✅ 2. Poll Until Audio is Ready
        $audioUrl = null;
        $maxAttempts = 900;  // 40 ✅ supports long audio (1 hour)

        for ($i = 0; $i < $maxAttempts; $i++) {

            sleep(2); // ✅ slower polling for large audio

            $statusResponse = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
            ])->get("https://genaipro.vn/api/v1/labs/task/" . $taskId);

            $status = $statusResponse->json()['status'] ?? null;
            $resultUrl = $statusResponse->json()['result'] ?? null;

            if ($status === 'completed' && $resultUrl) {
                $audioUrl = $resultUrl;
                break;
            }
        }

        if (!$audioUrl) {
            return response()->json([
                'success' => false,
                'message' => 'Audio generation still processing...'
            ]);
        }


        // ✅ 3. Download & Save Audio
        $fileName = 'voice_' . time() . '.mp3';
        $saveDir = public_path("generated");

        if (!file_exists($saveDir)) mkdir($saveDir, 0777, true);

        $audioData = file_get_contents($audioUrl);

        // ✅ detect JSON (error from API)
        if (strpos($audioData, '{') === 0) {
            return response()->json([
                'success' => false,
                'message' => "API returned JSON instead of MP3",
                'response' => $audioData
            ]);
        }

        file_put_contents("$saveDir/$fileName", $audioData);

        $publicAudioUrl = asset("generated/$fileName");


        // ✅ 4. Save Database Entry
        $voice = new VoiceGenerate();
        $voice->user_id = Auth::id();
        $voice->voice_name = $request->voice_name ?? 'Generated Voice';
        $voice->text = $text;
        $voice->language = $request->language ?? 'en-US';
        $voice->model = $request->model ?? "eleven_multilingual_v2";

        $voice->voice_settings = json_encode([
            'style' => $request->style ?? 0.5,
            'speed' => $request->speed ?? 1.0,
            'stability' => $request->stability ?? 0.5,
            'similarity' => $request->similarity ?? 0.75,
        ]);

        $voice->api_voice_id = $voiceId;
        $voice->audio_path = "generated/$fileName";
        $voice->started_time = now();
        $voice->completed_time = now();
        $voice->status = 'completed';
        $voice->save();


        // ✅ Deduct Credits
        $user->credits -= $requiredCredits;
        $user->save();
        // $user->credits = $currentSubscription->plan->characters;
        // $user->save();


        // ✅ 5. Return To Frontend
        return response()->json([
            'success' => true,
            'audio_url' => $publicAudioUrl,
            'voice' => $voice
        ]);

    } catch (\Exception $e) {

        return response()->json([
            'success' => false,
            'message' => 'Error generating voice',
            'error' => $e->getMessage()
        ]);
    }
}


//   public function generateAudioVoices(Request $request)
// {
//     $apiKey = env('GENAIPRO_API_KEY');
//     $voiceId = $request->voice_id ?? 'uju3wxzG5OhpWcoi3SMy'; // Default voice ID from GenAIPro
//     $text = $request->text;

//     if (!$text) {
//         return response()->json(['success' => false, 'message' => 'No text provided']);
//     }

//     $url = "https://genaipro.vn/api/v1/labs/task";

//     try {
//         // ✅ Correct JSON structure (matches cURL example)
//         $response = Http::withHeaders([
//             'Authorization' => 'Bearer ' . $apiKey,
//             'Content-Type' => 'application/json',
//         ])->post($url, [
//             "input" => $text,
//             "voice_id" => $voiceId,
//             "model_id" => "eleven_multilingual_v2",
//             "style" => (float)($request->style ?? 0.5),
//             "speed" => (float)($request->speed ?? 1.0),
//             "use_speaker_boost" => true,
//             "similarity" => (float)($request->similarity ?? 0.75),
//             "stability" => (float)($request->stability ?? 0.5),
//             "call_back_url" => url('/webhook'), // optional
//         ]);

//         if (!$response->ok()) {
//             return response()->json([
//                 'success' => false,
//                 'message' => 'Voice generation failed',
//                 'details' => $response->json() ?? $response->body(),
//             ], $response->status());
//         }

//         // ✅ Ensure folder exists
//         if (!file_exists(public_path('generated'))) {
//             mkdir(public_path('generated'), 0777, true);
//         }

//         // ✅ Save file (response may contain URL or audio blob)
//         $result = $response->json();

//         if (isset($result['data']['output_url'])) {
//             // If GenAIPro returns a link to audio file
//             $audioUrl = $result['data']['output_url'];
//         } else {
//             // If it returns raw audio (rare)
//             $fileName = 'voice_' . time() . '.mp3';
//             $path = public_path('generated/' . $fileName);
//             file_put_contents($path, $response->body());
//             $audioUrl = asset('generated/' . $fileName);

//         }

//         // ✅ Save to DB
//         $voice = new VoiceGenerate();
//         $voice->user_id = Auth::check() ? Auth::id() : null;
//         $voice->voice_name = $request->voice_name ?? 'Generated Voice';
//         $voice->text = $text;
//         $voice->language = $request->language ?? 'en-US';
//         $voice->model = $request->model ?? 'eleven_multilingual_v2';
//         $voice->voice_settings = json_encode([
//             'style' => (float)($request->style ?? 0.5),
//             'speed' => (float)($request->speed ?? 1.0),
//             'stability' => (float)($request->stability ?? 0.5),
//             'similarity' => (float)($request->similarity ?? 0.75),
//         ]);
//         $voice->api_voice_id = $voiceId;
//         $voice->audio_path = $audioUrl;
//         $voice->status = 'completed';
//         $voice->started_time = now();
//         $voice->completed_time = now();
//         $voice->save();

//         return response()->json([
//             'success' => true,
//             'audio_url' => $audioUrl,
//             'voice' => $voice,
//         ]);

//     } catch (\Exception $e) {
//         return response()->json([
//             'success' => false,
//             'message' => 'Error generating voice',
//             'error' => $e->getMessage(),
//         ], 500);
//     }
// }

}

