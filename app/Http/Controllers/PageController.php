<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class PageController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function getCreate(): \Illuminate\Contracts\View\View
    {
        $data = [
            'title' => trans('story.create_page'),
            'layouts' => [
                'play1' => 'Premier layout',
            ]
        ];

        $view = View::make('welcome', $data);

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
        ]);

        return $view;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Page         $page
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEdit(Request $request, Page $page): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|unique:stories',
            'description' => 'required',
            'layout' => 'required',
        ]);

        $validated['is_first']      = $request->has('is_first');
        $validated['is_last']       = $request->has('is_last');
        $validated['is_checkpoint'] = $request->has('is_checkpoint');

        if ($page->update($validated)) {
            \flash(trans('model.save_successful'));
        } else {
            \flash(trans('model.save_error'));
        }

        return Redirect::to(route('page.edit', ['page' => $page->id]));
    }
}
