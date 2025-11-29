<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class VoiceController extends Controller
{

    public function index(){
        return view('voices.index', ['voices' => []]);
    }

    public function filter(Request $request){
        try {
            // ✅ Get filters
            $language = strtolower($request->input('language', ''));
            $gender   = strtolower($request->input('gender', ''));
            $sort     = strtolower($request->input('sort', 'trending'));
            $search   = trim($request->input('search', ''));

            // ✅ Build API query
            $query = [
                'page'       => 0,
                'page_size'  => 100,
                'sort'       => $sort,
            ];

            if ($language !== '') $query['language'] = $language;
            if ($gender !== '')   $query['gender']   = $gender;
            if ($search !== '')   $query['search']   = $search;

            // ✅ Make API Request
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('GENAIPRO_API_KEY'),
            ])->timeout(15)->get('https://genaipro.vn/api/v1/labs/voices', $query);

            if ($response->failed()) {
                return response()->json([
                    'error'  => 'Failed to fetch voices from GenAI API',
                    'status' => $response->status(),
                    'body'   => $response->body(),
                ], 500);
            }

            $data = $response->json();

            if (isset($data['voices'])) {
                $voices = $data['voices'];
            } elseif (isset($data['voice_list'])) {
                $voices = $data['voice_list'];
            } elseif (is_array($data) && !empty($data) && isset($data[0])) {
                // ✅ THIS IS THE FIX: Data is already the voices array
                $voices = $data;
            } else {
                $voices = [];
            }

            // ✅ Return clean JSON
            return response()->json([
                'voices'     => $voices,
                'total'      => count($voices), // Since API returns array directly
                'page'       => 0,
                'page_size'  => 100,
                'debug'      => [ // Keep debug for now
                    'api_status' => $response->status(),
                    'data_type' => gettype($data),
                    'is_array' => is_array($data),
                    'voices_count' => count($voices),
                    'first_item_keys' => !empty($voices[0]) ? array_keys($voices[0]) : 'no voices'
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Server error: ' . $e->getMessage(),
            ], 500);
        }
    }


}
