<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Inventory;
use App\Models\Page;
use App\Models\PageLink;
use App\Models\Story;
use App\Repositories\PageRepository;
use Faker\Provider\Uuid;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
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
            ],

            'contexts' => ['action', 'prerequisites', 'riddle'],
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
                'title'         => 'required',
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
                    'page_to'   => $page->uuid,
                ], [
                    'link_text' => $validated['linktitle'],
                ]);

                Cache::forget('choices_' . $validated['page_from']);
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
    public function postRiddle (Request $request, Page $page): ?JsonResponse
    {
        if ($request->ajax()) {
            $result = strtolower(trim($request->get('answer'))) === strtolower(trim($page->riddle->answer));
            $response = null;

            if ($result) {
                if ($page->riddle && $page->riddle->item) {
                    $response = trans('page.riddle_item_earned', ['item_name' => $page->riddle->item->name]);
                    $storySession = Session::get('story');

                    // Flag the riddle as answered for this character
                    $page->riddle->answered_riddle()->create([
                        'character_id' => $storySession['character_id'],
                        'riddle_id' => $page->riddle->id
                    ]);

                    if ($page->riddle->item_id) {
                        Inventory::create(
                            [
                                'character_id' => $storySession['character_id'],
                                'item_id'      => $page->riddle->item_id,
                                'quantity'     => 1,
                            ]
                        );
                    }
                }
            }

            return response()->json([
                'success' => $result,
                'response' => $response,
                'solved' => $page->riddle ? $page->riddle->isSolved() : 'bouh',
                'refreshInventory' => $page->riddle && isset($page->riddle->item_id),
            ]);
        }

        abort(JsonResponse::HTTP_NOT_FOUND);
    }
}
