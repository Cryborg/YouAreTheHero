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
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home.home');
    }

    public function language(String $locale)
    {
        $locale = in_array($locale, config('app.languages')) ? $locale : config('app.fallback_locale');
        session(['locale' => $locale]);
        return back();
    }

    public function changelog()
    {
        return view('home.changelog');
    }
}
