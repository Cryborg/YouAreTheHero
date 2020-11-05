<?php

namespace App\Http\Controllers;

use App\Bases\ControllerBase;
use App\Models\Success;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class UserSuccessController extends ControllerBase
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param \App\Models\Success      $success
     * @param \App\Models\User         $user
     *
     * @return void
     */
    public function store(Request $request, Success $success, User $user)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\User    $user
     * @param \App\Models\Success $success
     *
     * @return void
     */
    public function show(User $user, Success $success)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User         $user
     * @param \App\Models\Success      $success
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, User $user, Success $success)
    {
        //TODO: use a fake Success id so that players cannot cheat
        if ($request->ajax()) {
            return Response::json($this->addSuccess($user, $success));
        }

        abort(JsonResponse::HTTP_NOT_FOUND);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
