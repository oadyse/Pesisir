<?php

namespace App\Http\Controllers;

use App\Models\DataUji;
use App\Models\Parameter;
use App\Models\SampelUji;
use App\Models\DataPesisir;
use Illuminate\Http\Request;

class DataHasilUjiController extends Controller
{
    public function index()
    {
        $data = DataUji::All();
        $pesisir = DataPesisir::All();
        $parameter = Parameter::All();
        $sampelUji = SampelUji::All();
        return view('data.uji.index', compact('data', 'pesisir', 'parameter', 'sampelUji'));
    }

    public function addNew(Request $request)
    {
        $addUji = DataUji::create([
            'id_pulau' => $request->id_pulau,
            'tahun' => $request->tahun,
        ]);
        $addUji->save();

        if ($addUji) {
            return redirect('/data-uji')->with("successAdd", "Data added successfully");
        } else {
            return redirect()->back()->withInput()->withErrors("Terjadi kesalahan");
        }
    }

    public function addNewParameter(Request $request)
    {
        foreach ($request->post('id_parameter') as $row => $val) {
            $addParameter = SampelUji::create([
                'id_uji' => $request->id_uji,
                'id_parameter' => $request->id_parameter[$row],
                'hasil' => 0,
            ]);
        }
        $addParameter->save();

        if ($addParameter) {
            return redirect('/data-uji')->with("successAdd", "Data added successfully");
        } else {
            return redirect()->back()->withInput()->withErrors("Terjadi kesalahan");
        }
    }

    public function processAddHasil(Request $request, $id)
    {
        $id = base64_decode($id);
        foreach ($request->input('hasil') as $row => $val) {
            $sampelUji = SampelUji::find($request->id[$row])->update([
                'id_uji' => $request->id_uji,
                'id_parameter' => $request->id_parameter[$row],
                'hasil' => $request->hasil[$row],
            ]);
        }

        if ($sampelUji) {
            return redirect('/data-uji')->with("successAdd", "Data added successfully");
        } else {
            return redirect()->back()->withInput()->withErrors("Terjadi kesalahan");
        }
    }
}
