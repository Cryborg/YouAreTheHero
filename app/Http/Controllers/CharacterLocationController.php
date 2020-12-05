<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Support\Facades\View;

class CharacterLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \App\Models\Character $character
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Character $character)
    {
        $data = [
            'locations' => $character->locations
        ];

        return View::make('character.location.index', $data);
    }
}
