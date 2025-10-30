<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CloneVoiceController extends Controller
{
    public function index()
    {
        return view('clonevoice.index');
    }
}
