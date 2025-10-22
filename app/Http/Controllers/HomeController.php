<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
        return view('home');
    }

    public function soporte()
    {
        return view('soporte');
    }

    public function especialista()
    {
        return view('especialista');
    }

    public function localizacion()
    {
        return view('localizacion');
    }

    public function indicador()
    {
        return view('indicador');
    }   
    
    public function tickets()
    {
        return view('tickets');
    }  

    public function kpi()
    {
        return view('kpi');
    }

    public function azure()
    {
        return view('azure');
    }
}
