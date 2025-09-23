<?php

namespace App\Http\Controllers;

use App\Models\AdThesis;

class AdThesisController extends Controller
{
    public function index()
    {
        $adTheses = AdThesis::all();
        return view('ad-theses.index', compact('adTheses'));
    }
}