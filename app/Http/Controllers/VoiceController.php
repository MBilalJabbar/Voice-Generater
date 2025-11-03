<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class VoiceController extends Controller
{
    // public function indesx()
    // {
    //     return view('voices.index');
    // }
    public function index()
    {
        try {
            // Send GET request to GenAI Pro
            $response = Http::withHeaders([
                'x-api-key' => env('GENAIPRO_API_KEY'),
            ])->timeout(10)->get('https://genaipro.vn/api/v1/max/voices');

            // Handle failed request
            if ($response->failed()) {
                return back()->with('error', 'Failed to fetch voices. Check your API key or internet connection.');
            }

            $data = $response->json();

            // Extract voice list from response
            $voices = $data['voice_list'] ?? [];

            if (empty($voices)) {
                return back()->with('error', 'No voices available.');
            }

            // Optional: sort by popularity if provided
            usort($voices, function ($a, $b) {
                return ($b['popularity'] ?? 0) <=> ($a['popularity'] ?? 0);
            });

            // Pass voices to Blade view
            return view('voices.index', compact('voices'));

        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            // Handle connection issues (cURL error 7)
            return back()->with('error', 'Could not connect to GenAI Pro API. Check your server internet/DNS.');
        } catch (\Exception $e) {
            return back()->with('error', 'An unexpected error occurred: ' . $e->getMessage());
        }
    }

}
