<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \App\Models\Story $story
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Story $story)
    {
        $data = [
            'story' => $story,
        ];

        return View::make('story.partials.locations_list', $data);
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
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Story        $story
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function store(Request $request, Story $story)
    {
        if ($request->post('name') !== null) {
            $location = $story->locations()->updateOrCreate([
                'page_id' => $request->post('page_id'),
            ], [
                'name' => $request->post('name'),
            ]);

            return Response::json([
                'success' => $location instanceof Location,
                'type' => 'save',
                'location' => $location,
            ]);
        }

        $deleted = $story->locations()->where('page_id', $request->post('page_id'))->delete();

        return Response::json([
            'success' => (bool)$deleted,
            'type' => 'delete',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Location  $location
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Location $location)
    {
        $update = $location->update([
            'name' => $request->get('name'),
        ]);

        return Response::json([
            'success' => $update,
            'type' => 'save',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Location  $location
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Location $location)
    {
        return Response::json([
            'success' => $location->delete(),
            'type' => 'delete',
        ]);
    }
}
