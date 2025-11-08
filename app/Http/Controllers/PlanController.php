<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::all();
        return view('plan.index', compact('plans'));
    }

     public function storePlans(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'duration' => 'required|string|max:100',
            'expires' => 'nullable|date',
            'characters' => 'nullable|integer',
            'minutes' => 'nullable|integer',
            'text_to_speech' => 'required|boolean',
            'bulk_voice_generation' => 'required|boolean',
            'voice_cloning' => 'required|boolean',
            'voice_effects' => 'required|boolean',
            'ultra_hd_audio' => 'required|boolean',
            'all_voices_models' => 'required|boolean',
            'priority_usage' => 'required|boolean',
            'faster_processing' => 'required|boolean',
            'team_studio_usage' => 'required|boolean',
            'premium_support' => 'required|boolean',
            'extended_usage' => 'required|boolean',
        ]);

        Plan::create($validated);

        return redirect()->route('showPlansTable')->with('success', 'Plan created successfully!');
    }
    public function showPlansTable(){
        $plans = Plan::all();
        // dd($plans);
        return view('admin.plans.index', compact('plans'));
    }

    public function editPlans($id){
        $plansEdit = Plan::find($id);
        return view('admin.plans.create', compact('plansEdit'));
    }
    public function updatePlans(Request $request, $id){
        $updatePlans = Plan::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'duration' => 'required|string|max:100',
            'expires' => 'nullable|date',
            'characters' => 'nullable|integer',
            'minutes' => 'nullable|integer',
            'text_to_speech' => 'required|boolean',
            'bulk_voice_generation' => 'required|boolean',
            'voice_cloning' => 'required|boolean',
            'voice_effects' => 'required|boolean',
            'ultra_hd_audio' => 'required|boolean',
            'all_voices_models' => 'required|boolean',
            'priority_usage' => 'required|boolean',
            'faster_processing' => 'required|boolean',
            'team_studio_usage' => 'required|boolean',
            'premium_support' => 'required|boolean',
            'extended_usage' => 'required|boolean',
        ]);
        $updatePlans->update($validated);
        return redirect()->route('showPlansTable');
    }

    public function deletedPlans($id){
        $plan = Plan::find($id);
        if(!$plan){
            return response()->json(['message' => 'Plans Not Found'], 404);
        }
        $plan->delete();
        return response()->json(['message' => 'Plan deleted successfully.']);
    }

    public function ShowPlanWeb(){
        $plans = Plan::all();
        return view('welcome', compact('plans'));
    }
}
