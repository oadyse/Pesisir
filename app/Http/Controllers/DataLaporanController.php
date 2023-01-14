<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataLaporanController extends Controller
{
    public function index()
    {
        return view('data.laporan.index');
    }
}
