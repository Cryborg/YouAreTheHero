<?php

namespace App\Http\Controllers;

use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Spatie\Activitylog\Models\Activity;

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

        // Count words in the whole story. Cache this later
        $stories->map(function ($story) {
            // Count words and pages
            $story->wordsCount = 0;
            $story->pagesCount = $story->pages()->count();
            $story->pages->map(function ($page) use ($story) {
                $story->wordsCount += count(explode(' ', $page->content));
            });

            // Statistics
//            $activities = Activity::
//                ->where('subject_type', Story::class)
//                ->where('subject_id', $story->id);
//
//            $story->statistics = [
//                'games_played'      => $activities->where('log_name', 'new_game')->count(),
//                'unique_players'    => $activities->where('log_name', 'new_game')->distinct('causer_id')->count(),
//                'games_reset'       => $activities->where('log_name', 'reset_game')->count(),
//                'games_finished'    => $activities->where('log_name', 'end_game')->count(),
//            ];

            $story->statistics = [
                'games_played'      => $this->getCommonActivityQuery($story)->where('log_name', 'new_game')->count(),
                'unique_players'    => $this->getCommonActivityQuery($story)->where('log_name', 'new_game')->distinct('causer_id')->count(),
                'games_reset'       => $this->getCommonActivityQuery($story)->where('log_name', 'reset_game')->count(),
                'games_finished'    => $this->getCommonActivityQuery($story)->where('log_name', 'end_game')->count(),
            ];
        });

        return View::make('stories.list', [
            'stories' => $stories
        ]);
    }

    private function getCommonActivityQuery($story)
    {
        return Activity::where('subject_type', Story::class)
                       ->where('subject_id', $story->id);
    }
}
