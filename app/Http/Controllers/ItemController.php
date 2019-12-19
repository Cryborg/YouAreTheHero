<?php

namespace App\Http\Controllers;

use App\Models\ActionPage;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Item         $item
     *
     * @return false|string
     * @throws \Exception
     */
    public function delete(Request $request, Item $item)
    {
        if ($request->ajax()) {
            $deleted = $item->delete();

            return json_encode(['success' => $deleted]);
        }

        abort(JsonResponse::HTTP_NOT_FOUND);
    }
}
