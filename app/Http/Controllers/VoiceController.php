<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VoiceController extends Controller
{
    public function index()
    {
        return view('voices.index');
    }
}
