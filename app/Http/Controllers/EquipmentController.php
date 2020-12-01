<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

class EquipmentController extends Controller
{
    public function index(Request $request, Story $story)
    {
        $data = [
            'story' => $story,
        ];

        return View::make('story.partials.slots_list', $data);
    }

    public function store(Request $request, Story $story)
    {
        $newEquipment = $story->equipment()->create([
            'slot' => $request->get('slot'),
        ]);

        return Response::json([
            'success' => $newEquipment instanceof Equipment,
            'type'    => 'save',
        ]);
    }

    public function update(Request $request, Equipment $equipment)
    {
        $result = $equipment->update([
            'slot' => $request->get('slot'),
        ]);

        return Response::json([
            'success' => $result,
            'type' => 'save',
        ]);
    }

    public function delete(Request $request, Story $story, Equipment $equipment)
    {
        return Response::json([
            'success' => (bool)$story->equipment()->where('id', $equipment->id)->delete(),
            'type' => 'delete',
        ]);
    }
}
