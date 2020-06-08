<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\CharacterItem;
use App\Models\Inventory;
use App\Models\Item;
use App\Models\Page;
use App\Models\Choice;
use App\Models\Story;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class PageController extends Controller
{
    private $placeholders;

    public function __construct()
    {
        $this->middleware('auth');

        // List of placeholders in the Summernote editor
        $this->placeholders = [
            'character_name' => trans('character.name_label'),
        ];
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Story        $story
     * @param \App\Models\Page|null    $page
     *
     */
    public function create(Request $request, Story $story, Page $page = null)
    {
        $redirect = null;

        if ($page === null) {
            $page     = factory(Page::class)->create([
                'story_id' => $story->id,
            ]);
            $redirect = route('page.edit', ['page' => $page]);
        }

        $pageFromId = (int)$request->get('page_from', 0);

        // Create the link between the two pages
        if ($pageFromId > 0) {
            $page->parents()->attach($pageFromId,
                    [
                        'link_text' => $request->get('link_text'),
                    ]);

            Cache::forget('choices_' . $pageFromId);
        }

        return response()->json([
            'page'     => $page,
            'redirect' => $redirect,
        ]);
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

        $view = View::make('page.create',
            [
                'title'   => $page->story->title,
                'story'   => $page->story,
                'page'    => $page,
                'layouts' => [
                    'play1' => 'Premier layout (ok)',
                    'play2' => 'Deuxième layout (pour test)',
                ],
                'locales' => getLanguages(),
                'actions' => [
                    'take' => trans('item_page.take'),
                    'buy'  => trans('item_page.buy'),
                    'sell' => trans('item_page.sell'),
                    'give' => trans('item_page.give'),
                ],

                'contexts' => ['item_page', 'add_actions', 'prerequisites', 'riddle', 'story_creation', 'report'],

                'placeholders' => $this->placeholders,
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
            $this->authorize('edit', $page);

            $validated = $request->validate([
                'title'         => 'required',
                'content'       => 'required',
                'layout'        => 'sometimes|required',
                'is_first'      => 'required',
                'is_last'       => 'required',
                'is_checkpoint' => 'required',
            ]);

            if ($page->update($validated)) {
                // Invalidate cache
                Cache::forget('page_' . $page->id);

                return response()->json([
                    'success' => true,
                    'content' => $page->present()->content,
                ]);
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
    public function postRiddle(Request $request, Page $page): ?JsonResponse
    {
        if ($request->ajax()) {
            $this->authorize('edit', $page);

            $answerIsCorrect = strtolower(trim($request->post('answer'))) === strtolower(trim($page->riddle->answer));
            $storySession    = Session::get('story');
            $itemResponse    = null;
            $pageResponse    = null;

            if ($answerIsCorrect) {
                // If the player earns an item
                if ($page->riddle && $page->riddle->item) {
                    $itemResponse = trans('page.riddle_item_earned', ['item_name' => $page->riddle->item->name]);

                    if ($page->riddle->item_id) {
                        $character = Character::find($storySession['character_id']);
                        $character->items()->attach([
                                'item_id'  => $page->riddle->item_id,
                                'quantity' => 1,
                            ]);
                    }
                }

                // If it unlocks a new page
                //FIXME: Moche, mettre ça dans un partial
                if ($page->riddle && $page->riddle->target_page_id) {
                    $pageResponse = '<div class="choices-links button-group"><a data-href="' . route('story.play',
                            ['story' => $page->story->id, 'page' => $page->id]) . '">
                        <button class="large button">' . $page->riddle->target_page_text . '</button>
                    </a></div>';
                    $itemResponse = trans('page.riddle_already_solved');
                }

                // Flag the riddle as answered for this character
                $page->riddle->character()->attach($storySession['character_id'],
                    [
                        'riddle_id' => $page->riddle->id,
                    ]);
            }

            return response()->json([
                'success'          => $answerIsCorrect,
                'itemResponse'     => $itemResponse,
                'pageResponse'     => $pageResponse,
                'solved'           => $page->riddle ? $page->riddle->isSolved() : 'bouh',
                'refreshInventory' => $page->riddle && $page->riddle->item_id,
                'refreshChoices'   => $page->riddle && $page->riddle->target_page_id,
            ]);
        }

        abort(JsonResponse::HTTP_NOT_FOUND);
    }

    public function delete(Request $request, Page $page)
    {
        if ($request->ajax()) {
            $this->authorize('edit', $page);

            $success = true;
            $message = null;
            $story   = $page->story;

            try {
                $page->delete();
            } catch (\Exception $e) {
                $success = false;
                $message = $e->getMessage();
            }

            return response()->json([
                'success'    => $success,
                'message'    => $message,
                'redirectTo' => route('page.edit', ['page' => $story->getLastCreatedPage()]),
            ]);
        }

        abort(JsonResponse::HTTP_NOT_FOUND);
    }

    public function deleteChoice(Request $request, Page $page, Page $pageFrom)
    {
        if ($request->ajax()) {
            $this->authorize('edit', $page);

            $success = true;
            $message = null;

            try {
                $pageFrom->choices()->detach($page->id);
            } catch (\Exception $e) {
                $success = false;
                $message = $e->getMessage();
            }

            Cache::forget('choices_' . $pageFrom->id);

            return response()->json([
                'success'  => $success,
                'message'  => $message,
                'page'     => $page->id,
                'pageFrom' => $pageFrom->id,
            ]);
        }

        abort(JsonResponse::HTTP_NOT_FOUND);
    }

    public function list(Story $story)
    {
        $view = View::make('page.partials.modal_list_pages',
            [
                'pages' => $story->pages->sortBy('created_at')->sortByDesc('is_first')->sortBy('is_last'),
            ]);

        return $view;
    }

    /**
     * @param \App\Models\Story $story
     * @param \App\Models\Page  $page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function availableChoices(Page $page)
    {
        $character = $page->story->currentCharacter();

        $this->getFilteredChoicesFromPage($page, $character);

        return view('story.partials.choices',
            [
                'page' => $page,
            ]);
    }

    public function deleteItem(Page $page, Item $item, string $verb)
    {
        return response()->json([
            'success' => $page->items()->wherePivot('verb', $verb)->detach($item->id),
        ]);
    }

    public function storeItem(Request $request, Page $page)
    {
        if ($request->ajax()) {
            $validated = $request->validate([
                'item_id'  => 'required',
                'verb'     => 'required',
                'quantity' => 'required',
                'price'    => '',
            ]);

            $validated['page_id'] = $page->id;

            try {
                $attached = $page->items()->syncWithoutDetaching([
                        $validated['item_id'] => [
                            'verb'     => $validated['verb'],
                            'quantity' => $validated['quantity'],
                            'price'    => $validated['price'],
                        ],
                    ]);

                return response()->json([
                    'success' => true,
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage(),
                ]);
            }
        }

        abort(JsonResponse::HTTP_NOT_FOUND);
    }

    /**
     * @param \App\Models\Page $page
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function listItems(Page $page)
    {
        return View::make('page.partials.item_page_list', ['items' => $page->items]);
    }
}
