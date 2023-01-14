<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataHasilUjiController extends Controller
{
    public function index()
    {
        return view('data.uji.index');
    }
}
