<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\PageLink;
use App\Models\Story;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class PageController extends Controller
{
    /**
     * @param \App\Models\Story $story
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function getCreate(Request $request, Story $story): \Illuminate\Contracts\View\View
    {
        $page = factory(Page::class)->make();
        $page->story_id = $story->id;
        $page->id = (string) substr(Uuid::uuid(), 0, 32);
        $page->save();

        $view = View::make('page.partials.create', [
            'page' => $page,
            'layouts' => [
                'play1' => 'Premier layout',
            ],
            'internalId' => $request->get('internalId') ?? 0,
        ]);

        return $view;
    }

    /**
     * @param \App\Models\Page $page
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function getEdit(Page $page): \Illuminate\Contracts\View\View
    {
        $view = View::make('page.create', [
            'title' => trans('model.title'),
            'page' => $page,
            'layouts' => [
                'play1' => 'Premier layout',
            ],
            'locales' => [
                'fr_FR' => 'Français',
                'en_US' => 'Anglais',
                'es_ES' => 'Espagnol',
            ],
            'internalId' => 0,
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
                'description' => 'required',
                'layout'      => 'required',
                'linktitle'   => 'required',
                'page_from'   => 'required',
            ]);

            $validated['is_first']      = $request->has('is_first');
            $validated['is_last']       = $request->has('is_last');
            $validated['is_checkpoint'] = $request->has('is_checkpoint');

            PageLink::create([
                'link_text' => $validated['linktitle'],
                'page_from' => $validated['page_from'],
                'page_to' => $page->id,
            ]);

            unset($validated['linktitle']);
            unset($validated['page_from']);

            if ($page->update($validated)) {
                \flash(trans('model.save_successful'));

                return response()->json(['success' => true]);
            }

            \flash(trans('model.save_error'));

            return response()->json(['success' => false]);
        }

        abort(404);
    }
}
