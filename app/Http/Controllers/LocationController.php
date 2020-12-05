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
        // New location
        if ($request->post('name') !== null) {
            $pageId = $request->post('page_id', null);

            if ($pageId !== null) {
                $location = $story->locations()->updateOrCreate([
                   'page_id' => $pageId,
                ], [
                    'name' => $request->post('name'),
                ]);
            } else {
                $location = $story->locations()->create([
                    'name' => $request->post('name')
                ]);
            }

            return Response::json([
                'success' => $location instanceof Location,
                'type' => 'save',
                'location' => $location,
                'refreshLocations' => true
            ]);
        }

        // Update location with a page
        if ($request->post('location_id')) {
            $location = $story->locations()->updateOrCreate([
                'id' => $request->post('location_id')
            ], [
                'page_id' => $request->post('page_id')
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
            'refreshLocations' => true
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
            'refreshLocations' => true
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
            'refreshLocations' => true
        ]);
    }
}
