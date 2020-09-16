<?php

namespace App\Http\Controllers;

use App\Models\Choice;
use App\Models\Page;
use Illuminate\Http\Request;

class ChoiceController extends Controller
{
    public function get(Page $pageFrom, Page $pageTo)
    {
        return response()->json([
            'choice' => Choice::where('page_from', $pageFrom->id)->where('page_to', $pageTo->id)->first(),
        ]);
    }

    public function update(Request $request, Choice $choice)
    {
        $success = $choice->update($request->all());

        return response()->json([
            'success' => $success,
            'type'    => 'save',
        ]);
    }
}
