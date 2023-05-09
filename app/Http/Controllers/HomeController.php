<?php

namespace App\Http\Controllers;

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
        $this->middleware('auth');
        return view('dashboard');
    }
    
    public function userHome()
    {
        $this->middleware('auth');
        return view('dashboard');
    }
}
