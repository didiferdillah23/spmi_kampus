<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokumen_mutu;

class PublicController extends Controller
{
    public function index()
    {
        $mutu = Dokumen_mutu::get();
        return view('public_page', compact('mutu'));
    }
}
