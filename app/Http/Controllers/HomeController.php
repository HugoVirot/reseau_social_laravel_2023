<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->only('index');
        $this->middleware('auth')->only('home');
    }

    public function index()
    {
        return view('index');
    }

    public function home()
    {
        return view('home');
    }
}
