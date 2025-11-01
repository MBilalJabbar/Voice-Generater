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

        return redirect()->route('admin.plans.index')->with('success', 'Plan created successfully!');
    }
}
