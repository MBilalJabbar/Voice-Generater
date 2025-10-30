<?php

namespace App\Http\Controllers;

use App\Models\VoiceGenerate;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class VoiceGeneratorController extends Controller
{
    public function fetchVoices() {
        $apiKey = env('ELEVENLABS_API_KEY');
        $response = Http::withHeaders([
            'xi-api-key' => $apiKey, ])->get('https://api.elevenlabs.io/v1/voices');

        return response()->json(json_decode($response->body(), true));
    }

    public function generateAudioVoice(Request $request) {
        $apiKey = env('ELEVENLABS_API_KEY');
        $voiceId = $request->voice_id ?? '21m00Tcm4TlvDq8ikWAM'; // default voice
        $text = $request->text; // ensure text exists
            if (!$text) {
                return response()->json(['success' => false, 'message' => 'No text provided']);
            }
            // make ElevenLabs request
            $response = Http::withHeaders([
                'xi-api-key' => $apiKey,
                'Accept' => 'audio/mpeg', // important!
            ])->post("https://api.elevenlabs.io/v1/text-to-speech/$voiceId", [
                    "text" => $text,
                    "model_id" => "eleven_multilingual_v2",
                    "voice_settings" => [
                        "stability" => (float)($request->stability ?? 0.5),
                        "similarity_boost" => (float)($request->similarity ?? 0.5),
                        "style" => (float)($request->style ?? 0.5),
                        "speed" => (float)($request->speed ?? 1.0), ]
                    ]);
                         // handle response
                        if ($response->ok()) { // ensure folder exists
                            if (!file_exists(public_path('generated'))) {
                                 mkdir(public_path('generated'), 0777, true); }
                                 // save file
                            $fileName = 'voice_' . time() . '.mp3';
                            $path = public_path('generated/' . $fileName);
                            file_put_contents($path, $response->body());
                            $voice = new VoiceGenerate();
                            $voice->user_id = Auth::check() ? Auth::id() : null;
                            $voice->voice_name = $request->voice_name ?? 'Generated Voice';
                            $voice->text = $request->text ?? null;
                            $voice->language = $request->language ?? 'en-US';
                            $voice->model = $request->model ?? 'eleven_multilingual_v2';
                            $voice->voice_settings = json_encode([
                                "stability" => (float)($request->stability ?? 0.5),
                                "similarity_boost" => (float)($request->similarity ?? 0.5),
                                "style" => (float)($request->style ?? 0.5),
                                "speed" => (float)($request->speed ?? 1.0), ]);
                            $voice->api_voice_id = $voiceId;
                            $voice->audio_path = 'generated/' . $fileName;
                            $voice->status = 'progress';
                            $voice->started_time = Carbon::now();
                            $voice->save();

                            try{
                                $voice->status = 'completed';
                                $voice->completed_time = Carbon::now();
                                $voice->save();
                            }catch(\Exception $e){
                                $voice->status = 'failed';
                                $voice->save();
                            } return response()->json([
                                'success' => true,
                                'audio_url' => asset('generated/' . $fileName),
                                'voice' => $voice ]);
                            } // error response
                            return response()->json([
                                'success' => false,
                                'message' => 'Voice generation failed',
                                'details' => $response->json(),
                            ], $response->status());
    }
}


