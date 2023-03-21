<?php

namespace App\Http\Controllers;

use App\Models\DataUji;
use Illuminate\Http\Request;

class DataLaporanController extends Controller
{
    public function index()
    {
        $data = DataUji::All();
        return view('data.laporan.index', compact('data'));
    }

    public function detail($id)
    {
        $id = base64_decode($id);
        $data = DataUji::where('id', $id)->first;
        return view('data.laporan.detail_laporan', compact('data'));
    }
}
