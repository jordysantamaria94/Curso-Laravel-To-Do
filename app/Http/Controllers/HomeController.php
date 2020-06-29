<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listas;
use App\Models\Tareas;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $listas = Listas::all();

        return view('home')->with('listas', $listas);
    }
}
