<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\Item;
use App\Models\Page;
use App\Models\Story;
use App\Repositories\ChoiceRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

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
            $newPage = [
                'story_id' => $story->id
            ];

            if ($request->get('link_text')) {
                $newPage['title'] = $request->get('link_text');
            }

            $page     = factory(Page::class)->create($newPage);
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
            'graph' => $this->buildGraph($page->story),
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

                'graph' => $this->buildGraph($page->story),
            ]);

        return $view;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Page         $page
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException|\Laracasts\Presenter\Exceptions\PresenterException
     */
    public function postEdit(Request $request, Page $page): ?JsonResponse
    {
        if ($request->ajax()) {
            $this->authorize('edit', $page);

            $validated = $request->validate([
                'title'         => 'required',
                'content'       => 'required',
                'layout'        => 'sometimes|required',
                'is_first'      => 'required',
                'is_last'       => 'required',
                'ending_type'   => 'required_if:is_last,on',
                'is_checkpoint' => 'required',
            ]);

            if ($page->update($validated)) {
                // Invalidate cache
                Cache::forget('page_' . $page->id);

                return response()->json([
                    'success' => true,
                    'content' => $page->present()->content,
                    'graph' => $this->buildGraph($page->story)
                ]);
            }

            \flash(trans('model.save_error'));

            return response()->json([
                'success' => false,
            ]);
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
        if ($request->ajax())
        {
            $answerIsCorrect = strtolower(trim($request->post('answer'))) === strtolower(trim($page->riddle->answer));
            $storySession    = Session::get('story');
            $itemResponse    = null;
            $pageResponse    = null;
            $character       = Character::find($storySession['character_id']);

            if ($answerIsCorrect) {
                // If the player earns an item
                if ($page->riddle && $page->riddle->item) {
                    $itemResponse = trans('page.riddle_item_earned', ['item_name' => $page->riddle->item->name]);

                    if ($page->riddle->item_id) {
                        $character->items()->attach([
                            'item_id'  => $page->riddle->item_id,
                            'quantity' => 1,
                        ]);
                    }
                }

                // If it unlocks a new page
                //FIXME: Moche, mettre ça dans un partial
                if ($page->riddle && $page->riddle->target_page_id) {
                    $pageResponse = '<div class="choices-links button-group w-100">' .
                        '<a data-href="' . route('story.play', ['story' => $page->story->id, 'page' => $page->riddle->target_page_id]) . '" data-page-id="' . $page->riddle->target_page_id . '">' .
                        '<button class="large button w-100" data-original-text="' . $page->riddle->target_page_text . '">' . $page->riddle->target_page_text . '</button>' .
                        '</a></div>';
                    $itemResponse = trans('page.riddle_already_solved');
                }

                // Flag the riddle as answered for this character
                $page->riddle->characters()->attach($storySession['character_id'],
                    [
                        'riddle_id' => $page->riddle->id,
                    ]);
            }

            return response()->json([
                'success'          => $answerIsCorrect,
                'itemResponse'     => $itemResponse,
                'pageResponse'     => $pageResponse,
                'solved'           => $page->riddle ? $page->riddle->isSolved($character) : false,
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
                'graph'    => $this->buildGraph($page->story),
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

        ChoiceRepository::getFilteredChoicesFromPage($page, $character);

        return view('story.partials.choices',
            [
                'page' => $page,
                'character' => $character,
            ]);
    }

    public function deleteItem(Page $page, Item $item)
    {
        return response()->json([
            'success' => $page->items()->detach($item->id),
        ]);
    }

    public function storeItem(Request $request, Page $page)
    {
        if ($request->ajax()) {
            $validated = $request->validate([
                'item_id'  => 'required',
                'quantity' => 'required',
                'price'    => '',
            ]);

            $validated['page_id'] = $page->id;

            try {
                $page->items()->syncWithoutDetaching([
                    $validated['item_id'] => [
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

    /**
     * @param \App\Models\Story $story
     *
     * @return string
     */
    private function buildGraph(Story $story, Page $currentPage = null)
    {
        $graph = collect();
        $graph->push(
            'digraph{',
            'node [labelType="html" labelStyle="margin-top: 4px;" class="align-middle text-center" rx="10" ry="10" fill="red"];',
            'edge [labelType="html" labelStyle="border: 1px solid white;color:white;background-color:black;padding:3px;font-size:.8em"];'
        );

        foreach ($story->pages as $page) {
            $icon = '';

            if ($page->is_last) {
                if ($page->ending_type === Page::ENDING_BAD) {
                    $icon = '<span class="icon-skull text-red font-biggest mr-2"></span>';
                }

                if ($page->ending_type === Page::ENDING_GOOD) {
                    $icon = '<span class="icon-thumb-up text-green font-biggest mr-2"></span>';
                }
            }

            $editPageLink = Str::replaceFirst(
                '?',
                route('page.edit', ['page' => $page]),
                '<a href="?">' . $icon . addslashes($page->title) . '</a>'
            );

            $graph->push(
                $page->id . ' [label="' . addslashes($editPageLink) . '"];'
            );

            if ($page->choices()->count() > 0) {
                foreach ($page->choices as $choice) {
                    $html = Str::replaceArray('?',
                        [$choice->id, $page->id, addslashes($choice->pivot->link_text)],
                        '<div
                            data-page-to="?"
                            data-page-from="?">
                            <span class="choice-text icon-fountain-pen text-white clickable border-right border-light p-1 mr-2"></span>
                            <span class="link-text">?</span>
                            <span class="choice-text icon-trash clickable text-red border-left border-light p-1 ml-2"></span>
                        </div>');
                    $html = preg_replace('/\s+/', ' ', str_replace(array("\r", "\n"), '', $html));
                    $graph->push(
                        $page->id . '->' . $choice->id . ' [label="' . addslashes($html) . '"];' . "\n"
                    );
                }
            }

            // If the page contains a riddle, and it links to another page
            if (!empty($page->riddle)) {
                if ($page->riddle->target_page_id) {
                    $html = Str::replaceArray('?',
                        [addslashes($page->riddle->target_page_text)],
                        '<div class="bg-white text-black">
                            <span class="riddle-text icon-jigsaw-piece text-black border-right border-dark p-1 mr-2"></span>
                            <span class="link-text">?</span>
                            <span class="riddle-text icon-trash clickable text-red border-left border-dark p-1 ml-2"></span>
                        </div>');
                    $html = preg_replace('/\s+/', ' ', str_replace(array("\r", "\n"), '', $html));
                    $graph->push(
                        $page->id . '->' . $page->riddle->target_page_id
                              . ' [label="' . addslashes($html) . '" style="stroke: white; stroke-dasharray: 5;" arrowheadStyle="fill: white"];' . "\n"
                    );
                }
            }
        }

        $graph->push(
            '}'
        );

        return $graph->implode("\n");
    }
}
