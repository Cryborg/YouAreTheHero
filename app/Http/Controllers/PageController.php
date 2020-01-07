<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Page;
use App\Models\PageLink;
use App\Models\Story;
use App\Repositories\PageRepository;
use Faker\Provider\Uuid;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Story        $story
     * @param \App\Models\Page|null    $page
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function getCreate(Request $request, Story $story, Page $page = null): \Illuminate\Contracts\View\View
    {
        if ($page === null) {
            $page = factory(Page::class)->create([
                'story_id' => $story->id
            ]);
        }

        $view = View::make('page.partials.create', [
            'story' => $story,
            'page' => $page,
            'layouts' => [
                'play1' => 'Premier layout',
            ],
            'internalId' => $request->get('internalId') ?? 1,
        ]);

        return $view;
    }

    /**
     * @param \App\Models\Page $page
     *
     * @return \Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function getEdit(Page $page): \Illuminate\Contracts\View\View
    {
        $this->authorize('view', $page);

        $view = View::make('page.create', [
            'title' => trans('model.title'),
            'story' => $page->story,
            'page' => $page,
            'layouts' => [
                'play1' => 'Premier layout (ok)',
                'play2' => 'Deuxième layout (pour test)',
            ],
            'locales' => getLanguages(),
            'internalId' => 0,
            'actions' => [
                'buy' => trans('actions.buy'),
                'sell' => trans('actions.sell'),
                'earn' => trans('actions.earn'),
                'give' => trans('actions.give'),
            ]
        ]);

        return $view;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Page         $page
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function postEdit(Request $request, Page $page)
    {
        if ($request->ajax()) {
            $validated = $request->validate([
                'title'         => 'required|unique:stories',
                'content'       => 'required',
                'layout'        => 'required',
                'is_first'      => 'required',
                'is_last'       => 'required',
                'is_checkpoint' => 'required',
                'linktitle'     => 'sometimes|required',
                'page_from'     => 'sometimes|required',
            ]);

            if (isset($validated['linktitle'])) {
                PageLink::updateOrCreate([
                    'page_from' => $validated['page_from'],
                    'page_to'   => $page->id,
                ], [
                    'link_text' => $validated['linktitle'],
                ]);
            }

            unset($validated['linktitle'], $validated['page_from']);

            if ($page->update($validated)) {
                return response()->json(['success' => true]);
            }

            \flash(trans('model.save_error'));

            return response()->json(['success' => false]);
        }

        abort(JsonResponse::HTTP_NOT_FOUND);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Page         $page
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function postAddPrerequisite(Request $request, Page $page)
    {
        if ($request->ajax()) {
            if ($request->get('items')) {
                foreach ($request->get('items') as $characteristic) {
                    $page->prerequisites()->create([
                        'prerequisite_type' => 'item',
                        'prerequisite_id' => $characteristic,
                    ]);
                }
            }

            if ($request->get('sheet')) {
                foreach ($request->get('sheet') as $characteristic => $value) {
                    $page->prerequisites()->create([
                        'prerequisite_type' => 'sheet',
                        'prerequisite_id' => $characteristic,
                    ]);
                }
            }

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }
}
