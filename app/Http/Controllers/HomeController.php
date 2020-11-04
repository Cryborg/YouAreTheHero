<?php

namespace App\Http\Controllers;

use App\Bases\ControllerBase;

class HomeController extends ControllerBase
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

        if ($this->authUser) {
            $this->authUser->update(['locale' => $locale]);
        }
        return back();
    }

    public function changelog()
    {
        return view('home.changelog');
    }
}
