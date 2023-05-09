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
        $sampelUji = SampelUji::orderBy('uji_ke','asc')->get();
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
        $sampelUji = SampelUji::where(['id_uji'=>$request->id_uji])->get()->pluck('id_parameter')->toArray();
        $uji_ke = SampelUji::where(['id_uji'=>$request->id_uji])->get()->pluck('uji_ke','uji_ke')->toArray();
        if(!empty($sampelUji)) {
            foreach ($request->post('id_parameter') as $row => $val) {
                if(!in_array($request->id_parameter[$row],$sampelUji)) {
                    foreach($uji_ke as $isi) {
                        $addParameter = SampelUji::create([
                            'id_uji' => $request->id_uji,
                            'id_parameter' => $request->id_parameter[$row],
                            'hasil' => 0,
                            'uji_ke' => $isi,
                        ]);
                    }
                }
            }
        } else {
            foreach ($request->post('id_parameter') as $row => $val) {
                $addParameter = SampelUji::create([
                    'id_uji' => $request->id_uji,
                    'id_parameter' => $request->id_parameter[$row],
                    'hasil' => 0,
                ]);
            }
            $addParameter->save();
        }

        if ($addParameter) {
            return redirect('/data-uji')->with("successAdd", "Data added successfully");
        } else {
            return redirect()->back()->withInput()->withErrors("Terjadi kesalahan");
        }
    }

    public function processAddHasil(Request $request, $id)
    {
        $id = base64_decode($id);
        SampelUji::where(['id_uji'=>$id])->delete();
        $i = 1;
        foreach ($request->input('hasil') as $row => $val) {
            foreach($request->id_parameter[$row] as $key => $isi) {
                $sampelUji = SampelUji::create([
                    'id_uji' => $request->id_uji,
                    'id_parameter' => $isi,
                    'hasil' => $request->hasil[$row][$key],
                    'uji_ke' => $i,
                ]);
            }
            $i++;
        }

        if ($sampelUji) {
            return redirect('/data-uji')->with("successAdd", "Data added successfully");
        } else {
            return redirect()->back()->withInput()->withErrors("Terjadi kesalahan");
        }
    }
}
