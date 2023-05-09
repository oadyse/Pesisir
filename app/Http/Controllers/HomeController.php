<?php

namespace App\Http\Controllers;

use App\Models\DataUji;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    
    public function adminHome()
    {
        $this->middleware('auth');
        return view('dashboard');
    }
    
    public function userHome()
    {
        $this->middleware('auth');
        $data = DataUji::All();
        return view('dashboard', compact('data'));
    }
}
