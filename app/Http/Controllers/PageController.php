<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Page;
use App\Models\PageLink;
use App\Models\Story;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
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
     */
    public function postCreate(Request $request, Story $story, Page $page = null)
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
            'page_from' => $request->get('page_from')
        ]);

        return response()->json(
            [
                'success' => true,
                'view'    => html_entity_decode($view),
                'page'    => $page,
            ]
        );
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
            'title' => $page->story->title,
            'story' => $page->story,
            'page' => $page,
            'layouts' => [
                'play1' => 'Premier layout (ok)',
                'play2' => 'Deuxième layout (pour test)',
            ],
            'locales' => getLanguages(),
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
                'layout'        => 'sometimes|required',
                'is_first'      => 'required',
                'is_last'       => 'required',
                'is_checkpoint' => 'required',
                'link_text'     => 'sometimes|required',
                'page_from'     => 'sometimes|required',
            ]);

            if (isset($validated['link_text'], $validated['page_from']) && !empty($validated['link_text']) && !empty($validated['page_from'])) {
                PageLink::updateOrCreate([
                    'page_from' => $validated['page_from'],
                    'page_to'   => $page->id,
                ], [
                    'link_text' => $validated['link_text'],
                ]);

                Cache::forget('choices_' . $validated['page_from']);
            }

            unset($validated['link_text'], $validated['page_from']);

            if ($page->update($validated)) {
                // Invalidate cache
                Cache::forget('page_' . $page->id);

                return response()->json(['success' => true]);
            }

            \flash(trans('model.save_error'));

            return response()->json(['success' => false]);
        }

        abort(JsonResponse::HTTP_NOT_FOUND);
    }

    /**
     * Check wether the player answered the riddle correctly
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Page         $page
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function postRiddle (Request $request, Page $page): ?JsonResponse
    {
        if ($request->ajax()) {
            $result = strtolower(trim($request->get('answer'))) === strtolower(trim($page->riddle->answer));
            $itemResponse = null;
            $pageResponse = null;

            if ($result) {
                if ($page->riddle && $page->riddle->item) {
                    $itemResponse = trans('page.riddle_item_earned', ['item_name' => $page->riddle->item->name]);
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

                if ($page->riddle && $page->riddle->target_page) {
                    $pageResponse = $page->riddle->target_text;
                }
            }

            return response()->json([
                'success' => $result,
                'itemResponse' => $itemResponse,
                'pageResponse' => $pageResponse,
                'solved' => $page->riddle ? $page->riddle->isSolved() : 'bouh',
                'refreshInventory' => $page->riddle && (isset($page->riddle->item_id) || isset($page->riddle->target_page)),
            ]);
        }

        abort(JsonResponse::HTTP_NOT_FOUND);
    }
}
