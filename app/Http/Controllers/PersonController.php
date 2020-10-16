<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Story;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \App\Models\Story $story
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Story $story)
    {
        $data = [
            'persons' => $story->people,
            'title' => 'titre',
        ];

        return Response::view('person.list', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, Story $story)
    {
        if ($request->ajax()) {
            $validated = $request->validate([
                'first_name'      => 'required',
                'last_name'    => 'required',
                'role' => 'required',
            ]);

            // Next number
            $nextOrder = $story->people()->max('order');
            $validated['order'] = $nextOrder + 1;

            $person = $story->people()->create($validated);

            return Response::json([
                'success' => $person instanceof Person,
                'person' => $person->toArray()
            ]);
        }

        abort(JsonResponse::HTTP_NOT_FOUND);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function show(Person $person)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function edit(Person $person)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Person $person)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Story        $story
     * @param \App\Models\Person       $person
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Request $request, Story $story, Person $person)
    {
        if ($request->ajax()) {
            return response()->json([
                'success' => $person->delete(),
                'type'    => 'delete',
            ]);
        }

        abort(JsonResponse::HTTP_NOT_FOUND);

    }
}
