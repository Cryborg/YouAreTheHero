<?php

namespace App\Http\Controllers;

use App\Models\Choice;
use App\Models\Description;
use App\Models\Page;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

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
        $choice->update(['link_text' => $request->get('link_text')]);
    }
}
