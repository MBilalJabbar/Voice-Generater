<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
