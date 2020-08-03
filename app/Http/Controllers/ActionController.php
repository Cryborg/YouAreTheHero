<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Field;
use App\Models\Item;
use App\Models\Page;
use Illuminate\Http\Request;

class ActionController extends Controller
{
    public function createField(Request $request, Page $page, Field $field)
    {
        $action = Action::updateOrCreate([
            'trigger_id' => $page->id,
            'trigger_type' => 'page',
            'actionable_id' => $field->id,
            'actionable_type' => 'field',
        ], [
            'quantity' => $request->get('quantity')
        ]);

        $success = $page->triggers()->save($action);

        return response()->json([
            'success' => $success
        ]);
    }

    public function createItem(Request $request, Page $page, Item $item)
    {
        $action = Action::updateOrCreate([
            'trigger_id' => $page->id,
            'trigger_type' => 'page',
            'actionable_id' => $item->id,
            'actionable_type' => 'item',
        ], [
            'quantity' => $request->get('quantity')
        ]);

        $success = $page->triggers()->save($action);

        return response()->json([
            'success' => $success,
            'action' => [
                'type' => trans('actions.' . $action->actionable_type),
                'name' => $action->actionable->name,
                'quantity' => $action->quantity
            ]
        ]);
    }

    public function listjs(Page $page)
    {
        return response()->json([
           'actions' => $page->triggers
        ]);
    }

    function delete(Action $action)
    {
        return response()->json([
            'success' => $action->delete()
        ]);
    }
}
