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
            $age = strtolower($request->input('age', ''));
            $sort     = strtolower($request->input('sort', 'trending'));
            $search   = trim($request->input('search', ''));

            $validSorts = ['trending', 'created_date', 'cloned_by_count', 'usage_character_count_1y'];
            $sort = in_array($sort, $validSorts) ? $sort : 'trending';

            // ✅ Build API query
            $query = [
                'page'       => 0,
                'page_size'  => 100,
                'sort'       => $sort,
            ];

            if ($language !== '') $query['language'] = $language;
            if ($gender !== '')   $query['gender']   = $gender;
            if ($age !== '')      $query['age']      = $age;
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

            if (!empty($voices)) {
            switch ($sort) {
                case 'created_date': // Latest first
                    usort($voices, function ($a, $b) {
                        $aDate = isset($a['created_at']) ? strtotime($a['created_at']) : 0;
                        $bDate = isset($b['created_at']) ? strtotime($b['created_at']) : 0;
                        return $bDate <=> $aDate;
                    });
                    break;

                case 'cloned_by_count': // Most users first
                    usort($voices, function ($a, $b) {
                        $aCount = $a['cloned_by_count'] ?? 0;
                        $bCount = $b['cloned_by_count'] ?? 0;
                        return $bCount <=> $aCount;
                    });
                    break;

                case 'usage_character_count_1y': // Most usage first
                    usort($voices, function ($a, $b) {
                        $aUsage = $a['usage_character_count_1y'] ?? 0;
                        $bUsage = $b['usage_character_count_1y'] ?? 0;
                        return $bUsage <=> $aUsage;
                    });
                    break;

                case 'trending': // Default, keep API order
                default:
                    // no local sort needed
                    break;
            }
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
