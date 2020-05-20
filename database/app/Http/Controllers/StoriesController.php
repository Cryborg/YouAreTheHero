<?php

namespace App\Http\Controllers;

use App\Models\Story;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class StoriesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function list()
    {
        // Delete old story session
        Session::remove('story');

        $data = [
            'languages' => getLanguages(),
        ];

        return view('stories.list', $data);
    }

    public function listDraft()
    {
        // Delete old story session
        Session::remove('story');

        return view('stories.list_drafts');
    }

    /**
     * Fill the Datatables with stories
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     * @throws \Exception
     */
    public function ajaxList(Request $request)
    {
        $query = Story::select();

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

        $stories = $stories->map(function (Story $story, $key) {
            $user                       = Cache::remember('user.' . $story->user_id, Config::get('app.story.cache_ttl'), function() use ($story) {
                return User::where('id', $story->user_id)->first();
            });

            $name                       = $user->first_name . ' ' . $user->last_name;
            if (empty(trim($name))) {
                $name = $user->username;
            }

            $story['user']              = $name;
            $story['genres']            = $story->genres;
            $story['last_created_page'] = $story->getLastCreatedPage();
            $story['can_edit']          = Auth::id() == $story->user_id;
            $story['can_reset']         = Auth::user()->hasBeganStory($story);
            $story['locale']            = $story->present()->language;

            return $story;
        });

        return DataTables::of($stories)->make();
    }
}
