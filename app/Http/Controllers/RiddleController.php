<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class RiddleController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Page         $page
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function store(Request $request, Page $page): JsonResponse
    {
        $success = true;

        $validator = Validator::make($request->all(), [
            'answer'           => 'required',
            'item_id'          => '',
            'target_page_id'   => 'required_with:target_page_text',
            'target_page_text' => 'required_with:target_page_id',
            'type'             => 'required',
        ]);

        if ($validator->fails()) {
            $messages = collect();

            collect($validator->messages()->toArray())->each(static function ($message) use (&$messages) {
                $messages->push($message[0]);
            });

            $errors = $validator->getMessageBag()->toArray();
            $errors['type'] = 'save';
            $errors['success'] = false;
            $errors['message'] = $messages->join('<br>');

            return Response::json($errors, 200);
        }
        $validated = $validator->getData();

        $validated['type'] = $validated['type'] == 1 ? 'integer' : 'string';

        $validated = array_filter($validated);

        optional($page->riddle)->delete();

        $page->riddle()->create($validated);
        $page->load('riddle');
        $page->riddle->load('page');

        return response()->json([
            'success'    => $success,
            'riddle'     => $page->riddle,
            'page_title' => optional($page->riddle->page)->title,
            'item_name'  => optional($page->riddle->item)->name,
            'type'       => 'save',
        ]);
    }
}
