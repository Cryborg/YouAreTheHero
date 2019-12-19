<?php

namespace App\Http\Controllers;

use App\Models\ActionPage;
use App\Models\Page;
use App\Models\PageLink;
use App\Models\Story;
use App\Repositories\PageRepository;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;
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
            $page           = factory(Page::class)->make();
            $page->story_id = $story->id;
            $page->id       = Uuid::uuid();
            $page->save();
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
            'locales' => [
                'fr_FR' => trans('common.fr_FR'),
                'en_US' => trans('common.en_US'),
                'es_ES' => trans('common.es_ES'),
            ],
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
                'title'       => 'required|unique:stories',
                'content'     => 'required',
                'layout'      => 'required',
                'linktitle'   => 'sometimes|required',
                'page_from'   => 'required',
            ]);

            $validated['is_first']      = $request->has('is_first');
            $validated['is_last']       = $request->has('is_last');
            $validated['is_checkpoint'] = $request->has('is_checkpoint');

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
                \flash(trans('model.save_successful'));

                return response()->json(['success' => true]);
            }

            \flash(trans('model.save_error'));

            return response()->json(['success' => false]);
        }

        abort(JsonResponse::HTTP_NOT_FOUND);
    }

    public function addActionAjax(Request $request)
    {
        if ($request->ajax())
        {
            $validated = $request->validate([
                'items'         => 'required',
                'verb'          => 'required',
                'quantity'      => 'required',
                'price'         => '',
            ]);

            ActionPage::create($validated);
        }

        abort(JsonResponse::HTTP_NOT_FOUND);
    }
}
