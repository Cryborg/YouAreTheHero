<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\CharacterLocation;
use Illuminate\Http\Request;
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
    public function index()
    {
        $characterId = getSession('character_id');
        $character   = Character::where('id', $characterId)->firstOrFail();

        return View::make('character.location.index', ['locations' => $character->locations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CharacterLocation  $characterLocation
     * @return \Illuminate\Http\Response
     */
    public function show(CharacterLocation $characterLocation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CharacterLocation  $characterLocation
     * @return \Illuminate\Http\Response
     */
    public function edit(CharacterLocation $characterLocation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CharacterLocation  $characterLocation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CharacterLocation $characterLocation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CharacterLocation  $characterLocation
     * @return \Illuminate\Http\Response
     */
    public function destroy(CharacterLocation $characterLocation)
    {
        //
    }
}
