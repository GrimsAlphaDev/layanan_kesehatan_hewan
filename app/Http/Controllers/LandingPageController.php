<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PromosiKesehatanHewan;
use App\Models\KriteriaPenyakitMenular;

class LandingPageController extends Controller
{
    public function index()
    {

        $promosis = PromosiKesehatanHewan::all();
        $kriterias = KriteriaPenyakitMenular::all();
        
        return view('index', compact('promosis', 'kriterias'));
    }
}
