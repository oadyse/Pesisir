<?php

namespace App\Http\Controllers;

use App\Models\DataUji;
use App\Models\SampelUji;
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
        $data = SampelUji::where('id_uji', $id)->get();
        return view('data.laporan.detail_laporan', compact('data'));
    }
}
