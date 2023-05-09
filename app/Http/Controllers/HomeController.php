<?php

namespace App\Http\Controllers;

use App\Models\DataUji;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function status()
    {
        $data = Data
        return view('status');
    }

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    
    public function adminHome()
    {
<<<<<<< HEAD
        $this->middleware('auth');
=======
>>>>>>> f1e4f90... draft status kualitas air
        return view('dashboard');
    }
    
    public function userHome()
    {
<<<<<<< HEAD
        $this->middleware('auth');
        return view('dashboard');
=======
        $data = DataUji::All();
        return view('dashboard', compact('data'));
>>>>>>> f1e4f90... draft status kualitas air
    }
}
