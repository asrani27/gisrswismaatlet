<?php

namespace App\Http\Controllers;

use App\Kelurahan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $kelurahan = Kelurahan::all()->toArray();
        return view('index',compact('kelurahan'));
    }

    public function home()
    {
        $kelurahan = Kelurahan::all()->toArray();
        return view('admin.home',compact('kelurahan'));
    }

    public function polygon()
    {
        return view('admin.polygon');
    }
}
