<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Item;
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

        return Response::json([
            'inputs' => View::make('story.partials.slots_list', $data)->render(),
            'select' => View::make('story.partials.slots_select', $data)->render(),
        ]);
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

    public function delete(Request $request, Equipment $equipment)
    {
        try {
            $response = [
                'success' => false,
                'type'    => 'delete',
                'texts'   => [],
                'request' => $request->all()
            ];

            if (!$request->get('force'))
            {
                $usedInItems = Item::where('equipment_id', $equipment->id)->get();

                if ($usedInItems->count() > 0) {
                    $response['type']  = 'confirm';
                    $response['texts'] = [
                        'title'  => trans('equipment.deleting.title', ['equipment' => $equipment->slot]),
                        'button' => trans('equipment.deleting.button')
                    ];
                    $response['html'] = View::make('layouts.modals.template.deleting_equipment', ['items' => $usedInItems])->render();
                }
            }

            // If it is used nowhere, soft delete it
            if ($response['type'] === 'delete') {
                $response['success'] = $equipment->delete();
            }

            return Response::json($response);
        } catch (\Exception $e) {
            return Response::json([
                'success' => false,
                'type'    => 'delete',
            ]);
        }
    }
}
