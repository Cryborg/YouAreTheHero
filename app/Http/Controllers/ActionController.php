<?php

namespace App\Http\Controllers;

use App\Classes\Constants;
use App\Models\Action;
use App\Models\Field;
use App\Models\Item;
use App\Models\Location;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

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
            'success' => $success,
            'type'    => 'save',
        ]);
    }

    public function createItem(Request $request, Page $page)
    {
        $itemId = $request->get('item', null);

        if (empty($itemId) && $request->get('type') === 'currency') {
            $itemId = optional($page->story->currency)->id;
        }

        $action = Action::updateOrCreate([
            'trigger_id' => $page->id,
            'trigger_type' => 'page',
            'actionable_id' => $itemId,
            'actionable_type' => $request->get('type'),
        ], [
            'quantity' => $request->get('quantity'),
            'unique' => $request->get('unique_action', false),
        ]);

        $success = $page->triggers()->save($action);

        return response()->json([
            'success' => $success,
            'action' => [
                'type' => trans('actions.' . $action->actionable_type),
                'name' => $action->actionable->name ?? trans('story.currency_name_default'),
                'quantity' => $action->quantity
            ],
            'type' => 'save',
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
            'success' => $action->delete(),
            'type' => 'delete',
        ]);
    }

    /**
     * @param \App\Models\Page $page
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function list(Page $page)
    {
        $view = View::make('page.partials.actions_list', [
            'page' => $page
        ]);

        return $view;
    }

    public function createItemLocation(Item $item, Location $location)
    {
        Action::create([
            'trigger_type' => 'item',
            'trigger_id' => $item->id,
            'actionable_type' => 'location',
            'actionable_id' => $location->id,
            'quantity' => 1,
            'unique' => true,
        ]);
    }
}
