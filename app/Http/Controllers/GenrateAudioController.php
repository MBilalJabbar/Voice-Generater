<?php

namespace App\Http\Controllers;

use App\Models\BulkVoices;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class GenrateAudioController extends Controller
{
    public function genrateaudio(Request $request)
    {
        return view('genrateaudio.index');
    }

    public function genrateBulkAudio(Request $request)
    {
        return view('genrateaudio.bulkaudio');
    }


    // Bulk Voices Generate
    public function fetchGenAIBulkVoices(){
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('GENAIPRO_API_KEY'),
        ])->get('https://genaipro.vn/api/v1/labs/voices');

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

    public function generateBulkAudioVoices(Request $request){
        $apiKey = env('GENAIPRO_API_KEY');

        $texts = $request->texts; // Expecting array of texts
        $voiceId = $request->voice_id ?? 'uju3wxzG5OhpWcoi3SMy';

        if (!$texts || !is_array($texts)) {
            return response()->json(['success' => false, 'message' => 'No texts provided']);
        }
        $user = Auth::user();
        $currentSubscription = Subscription::where('user_id', $user->user_id)
            ->where('status', 'approved')
            ->whereHas('plan', function ($query) {
                $query->where('expires', '>=', now());
            })
            ->with('plan')
            ->first();
        if (!$currentSubscription) {
            return response()->json([
                'success' => false,
                'message' => 'Your subscription is not approved or expired.'
            ]);
        }

        $planCharacters = $currentSubscription->plan->characters ?? 0;
        $userCredits = $user->credits ?? 0;

        $results = [];

        foreach ($texts as $textItem) {
            $requiredCredits = mb_strlen($textItem);

            if ($user->credits < $requiredCredits) {
                $results[] = [
                    'text' => $textItem,
                    'success' => false,
                    'message' => 'Insufficient credits. Please upgrade your plan.',
                    'remaining_credits' => $user->credits,
                    'required' => $requiredCredits
                ];
                continue;
            }
            // if ($user->credits < $requiredCredits) {
            //     return response()->json([
            //         'success' => false,
            //         'message' => 'Insufficient credits. Please upgrade your plan.',
            //         'remaining_credits' => $user->credits,
            //         'required' => $requiredCredits
            //     ]);
            // }


            try {
                // 1. Create TTS Task
                $taskResponse = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $apiKey,
                ])->post('https://genaipro.vn/api/v1/labs/task', [
                    "input" => $textItem,
                    "voice_id" => $voiceId,
                    "model_id" => "eleven_multilingual_v2",
                    "style" => (float)($request->style ?? 0.5),
                    "speed" => (float)($request->speed ?? 1.0),
                    "similarity" => (float)($request->similarity ?? 0.75),
                    "stability" => (float)($request->stability ?? 0.5),
                    "use_speaker_boost" => true
                ]);

                if (!$taskResponse->ok()) {
                    $results[] = [
                        'text' => $textItem,
                        'success' => false,
                        'message' => 'Task creation failed',
                        'details' => $taskResponse->body()
                    ];
                    continue;
                }

                $taskId = $taskResponse->json()['task_id'] ?? null;
                if (!$taskId) {
                    $results[] = ['text' => $textItem, 'success' => false, 'message' => 'Task ID missing'];
                    continue;
                }

                // 2. Poll task status
                $audioUrl = null;
                $maxAttempts = 40;
                for ($i = 0; $i < $maxAttempts; $i++) {
                    sleep(2);
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
                    $results[] = ['text' => $textItem, 'success' => false, 'message' => 'Processing failed or still in progress'];
                    continue;
                }

                // 3. Save audio file
                $fileName = 'voice_' . time() . '_' . rand(1000,9999) . '.mp3';
                $savePath = public_path("generated/$fileName");
                if (!file_exists(public_path('generated'))) mkdir(public_path('generated'), 0777, true);

                $audioData = file_get_contents($audioUrl);

                if (strpos($audioData, '{') === 0) {
                    $results[] = ['text' => $textItem, 'success' => false, 'message' => 'Invalid audio response', 'response' => $audioData];
                    continue;
                }

                file_put_contents($savePath, $audioData);
                $publicAudioUrl = asset("generated/$fileName");

                // 4. Save to DB
                $voice = new BulkVoices();
                $voice->user_id = Auth::id() ?? null;
                $voice->voice_name = $request->voice_name ?? 'Generated Voice';
                $voice->text = $textItem;
                $voice->language = $request->language ?? 'en-US';
                $voice->model = "eleven_multilingual_v2";
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

                $user->credits -= $requiredCredits;
                $user->save();

                $results[] = [
                    'text' => $textItem,
                    'success' => true,
                    'audio_url' => $publicAudioUrl,
                    'voice_id' => $voice->id
                ];

            } catch (\Exception $e) {
                $results[] = ['text' => $textItem, 'success' => false, 'message' => $e->getMessage()];
            }
        }

        return response()->json($results);
    }

}
