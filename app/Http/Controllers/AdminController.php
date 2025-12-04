<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\User;
use App\Models\VoicesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::where('user_role', 'user')
                        ->orderBy('created_at', 'Desc')
                        ->take(15)
                        ->get();
        $userCount = $users->count();

        return view('admin.dashboard.index', compact('users', 'userCount'));
    }

//     public function GenAiCreditDetails()
// {
//     $response = Http::withHeaders([
//         'Authorization' => 'Bearer ' . env('GENAIPRO_API_KEY'),
//         'Accept' => 'application/json',
//     ])->get('https://genaipro.vn/api/v1/me');

//     if ($response->successful()) {
//         $data = $response->json();

//         // Extract user info and credits
//         $username = $data['username'] ?? 'N/A';
//         $balance = $data['balance'] ?? 0;
//         $credits = $data['credits'] ?? [];

//         // Calculate total and next expiration (optional)
//         $totalCredits = array_sum(array_column($credits, 'amount'));
//         $nextExpire = $credits[0]['expire_at'] ?? null;

//         return view('admin.dashboard.index', compact('username', 'balance', 'totalCredits', 'credits', 'nextExpire'));
//     }

//     return view('admin.dashboard.index')->withErrors([
//         'msg' => 'Failed to fetch GenAi credit details.'
//     ]);
// }



    // get user information with graph
    public function usersStats(Request $request){
        try {
            $year = $request->input('year', date('Y')); // default current year

            $users = User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                ->whereYear('created_at', $year)
                ->groupBy('month')
                ->orderBy('month')
                ->where('user_role', 'user')
                ->get();

            $dataPoints = [];

            // Include all 12 months even if no users
            for ($m = 1; $m <= 12; $m++) {
                $monthData = $users->firstWhere('month', $m);
                $dataPoints[] = [
                    'x' => Carbon::create($year, $m, 1)->toDateString(),
                    'y' => $monthData ? $monthData->count : 0
                ];
            }

            return response()->json($dataPoints);

        } catch (\Exception $e) {
            // Return JSON error for debugging
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }




    public function payment()
    {
        $paymentProofs = Subscription::with(['user', 'plan'])->orderBy('created_at', 'Desc')->get();

        return view('admin.payment.index', compact('paymentProofs'));
    }

    public function plansIndex()
    {
        return view('admin.plans.index');
    }

     public function plansCreate()
    {
        return view('admin.plans.create');
    }

     public function plansEdit()
    {
        return view('admin.plans.edit');
    }


    // Add Voices From Admin Dashboard
    public function createVoices(Request $request){
        $request->validate([
            'title' => 'required|string',
            'audio' => 'required|file|mimes:mp3,wav,ogg',
            'note' => 'nullable|string',
        ]);
        $fileName = time() . '.' . $request->audio->extension();
        $request->audio->move(public_path('voices'), $fileName);
        VoicesModel::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'audio_path' => 'voices/' . $fileName,
            'note' => $request->note,
        ]);
        return response()->json(['success' => true, 'message' => 'Voice Save successfully.']);


    }
     public function addvoices()
    {
        $voices = VoicesModel::all();
        return view('admin.voices.index', compact('voices'));
    }
    public function editVoice(Request $request, $id){
        $voice = VoicesModel::find($id);
        $request->validate([
            'title' => 'required|string',
            'audio' => 'nullable|file|mimes:mp3,wav,ogg',
            'note' => 'nullable|string',
        ]);
        $voice->title = $request->title;
        $voice->note = $request->note;
         if ($request->hasFile('audio')) {
        $fileName = time() . '.' . $request->audio->extension();
        $request->audio->move(public_path('voices'), $fileName);
        $voice->audio_path = 'voices/' . $fileName;
    }

        $voice->save();
        return response()->json(['success' => true, 'message' => 'Voice updated successfully.']);
    }

    public function deleteVoice($id){
        $voice = VoicesModel::find($id);
        $voice->delete();
        return response()->json(['success' => true, 'message' => 'Voice deleted successfully.']);
    }
}
