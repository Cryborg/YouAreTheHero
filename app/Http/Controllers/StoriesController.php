<?php

namespace App\Http\Controllers;

use App\Models\Story;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;

class StoriesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listDraft()
    {
        // Delete old story session
        Session::remove('story');

        return view('stories.list_drafts', [
            'stories' => Auth::user()->stories
        ]);
    }

    /**
     * Get the list of stories
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     * @throws \Exception
     */
    public function list(Request $request)
    {
        $query = Story::select()
            ->orderByDesc('updated_at')
            ->with(['pages']);

        $draft = $request->get('draft') == '1';

        if ($draft) {
            $query->where('is_published', false)
                ->where('user_id', Auth::id());
        }

        if (!Auth::user()->hasRole('admin')) {
            $query->where('user_id', Auth::id())
                ->orWhere('is_published', true);
        }

        $stories = $query->get();

        return View::make('stories.list', [
            'stories' => $stories
        ]);
    }
}
