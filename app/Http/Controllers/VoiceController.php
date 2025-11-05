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

// public function index()
// {
//     try {
//         $response = Http::withHeaders([
//             'Authorization' => 'Bearer ' . env('GENAIPRO_API_KEY'),
//         ])->timeout(10)->get('https://genaipro.vn/api/v1/max/voices?page=1&page_size=10&language=English&gender=Male');

//         if ($response->failed()) {
//             return back()->with('error', 'Failed to fetch voices. Check your API key or connection.');
//         }

//         $data = $response->json();
//         $voices = $data['voice_list'] ?? [];

//         if (empty($voices)) {
//             return back()->with('error', 'No voices available.');
//         }

//         return view('voices.index', compact('voices'));
//     } catch (\Illuminate\Http\Client\ConnectionException $e) {
//         return back()->with('error', 'Could not connect to GenAI Pro API.');
//     } catch (\Exception $e) {
//         return back()->with('error', 'Unexpected error: ' . $e->getMessage());
//     }
// }


// public function fetch(Request $request)
// {
//     $sort = $request->get('sort', '');
//     $language = $request->get('language', '');
//     $gender = $request->get('gender', '');

//     try {
//         $params = [
//             'page' => 1,
//             'page_size' => 12,
//         ];

//         if (!empty($sort)) $params['sort'] = $sort;
//         if (!empty($language)) $params['language'] = $language;
//         if (!empty($gender)) $params['gender'] = $gender;

//         \Log::info('API Request Params:', $params); // Log the parameters

//         $response = Http::withHeaders([
//             'Authorization' => 'Bearer ' . env('GENAIPRO_API_KEY'),
//         ])->timeout(10)->get('https://genaipro.vn/api/v1/labs/voices', $params);

//         // Debug the response
//         \Log::info('API Response Status:', ['status' => $response->status()]);
//         \Log::info('API Response Body:', $response->json() ?? ['error' => 'No response body']);

//         if ($response->failed()) {
//             \Log::error('API Request Failed:', [
//                 'status' => $response->status(),
//                 'body' => $response->body()
//             ]);
//             return response()->json(['html' => '<p class="text-danger">Failed to fetch voices from API. Status: ' . $response->status() . '</p>']);
//         }

//         $data = $response->json();
//         $voices = $data['voices'] ?? [];

//         \Log::info('Voices found:', ['count' => count($voices)]);

//         if (empty($voices)) {
//             return response()->json(['html' => '<p class="text-muted text-center">No voices found for this filter.</p>']);
//         }

//         $html = '';
//         foreach ($voices as $voice) {
//             $img = $voice['cover_url'] ?? asset('assets/images/default.png');
//             $audio = $voice['sample_audio'] ?? '';
//             $name = $voice['name'] ?? 'Unnamed';
//             $genderLabel = ucfirst($voice['labels']['gender'] ?? 'N/A');
//             $age = ucfirst($voice['labels']['age'] ?? '');
//             $accent = ucfirst($voice['labels']['accent'] ?? '');

//             $html .= '
//             <div class="col-xxl-4 col-lg-4 col-md-6 col-sm-12 mb-4">
//                 <div class="card custom-card shadow-sm" style="border-radius:10px; border:2px solid rgba(231,234,233,1); overflow:hidden;">
//                     <div class="card-body d-flex align-items-center p-3">
//                         <div class="voice-avatar-wrapper position-relative" style="width:100px; height:100px;">
//                             <img src="'.$img.'" class="voice-avatar rounded-circle" style="width:100%; height:100%; object-fit:cover; border:2px solid #ddd;">
//                             <div class="play-overlay d-flex justify-content-center align-items-center">
//                                 <button class="btn btn-light rounded-circle play-btn" data-audio="'.$audio.'" style="width:40px; height:40px;">
//                                     <i class="fa-solid fa-play"></i>
//                                 </button>
//                             </div>
//                         </div>
//                         <div class="flex-fill ms-3">
//                             <h5 class="fw-semibold mb-1 lh-1" style="font-size: 1rem;">'.$name.'</h5>
//                             <div class="voice-meta d-flex flex-column">
//                                 <span>'.$genderLabel.' • '.$age.'</span>
//                                 <span class="mt-1">'.$accent.'</span>
//                             </div>
//                         </div>
//                     </div>
//                 </div>
//             </div>';
//         }

//         return response()->json(['html' => $html]);

//     } catch (\Exception $e) {
//         \Log::error('Voice fetch error:', ['error' => $e->getMessage()]);
//         return response()->json(['html' => '<p class="text-danger">Error: ' . $e->getMessage() . '</p>']);
//     }
// }


public function index()
{
    // Return view with optional empty voices initially
    return view('voices.index', ['voices' => []]);
}

public function filter(Request $request)
{
    try {
        $language = $request->input('language');
        $gender = $request->input('gender');
        $sort = $request->input('sort'); // sort may be optional

        $query = [
            'page' => 1,
            'page_size' => 10,
        ];

        // Only include valid params
        if(!empty($language)) {
            $query['language'] = $language;
        }

        if(!empty($gender)) {
            $query['gender'] = $gender;
        }

        // Some APIs might not support "sort", only include if valid
        if(in_array($sort, ['trending','latest','mostusers'])) {
            $query['sort'] = $sort;
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('GENAIPRO_API_KEY'),
        ])->timeout(10)->get('https://genaipro.vn/api/v1/max/voices', $query);

        if ($response->failed()) {
            return response()->json([
                'error' => 'Failed to fetch voices from API',
                'status' => $response->status(),
                'body' => $response->body()
            ], 500);
        }

        $data = $response->json();
        $voices = $data['voice_list'] ?? [];

        return response()->json(['voices' => $voices]);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Server error: ' . $e->getMessage()], 500);
    }
}




}
