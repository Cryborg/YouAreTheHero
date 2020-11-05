<?php

namespace App\Http\Controllers;

use App\Bases\ControllerBase;
use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Spatie\Activitylog\Models\Activity;

class StoriesController extends ControllerBase
{

    public function __construct()
    {
        $this->middleware('auth');

        parent::__construct();
    }

    public function listDraft()
    {
        unsetSession();

        return view('stories.list_drafts', [
            'stories' => $this->authUser->stories
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
        unsetSession();

        $selectedLanguage = $request->get('language');

        $query = Story::select()
            ->orderByDesc('updated_at');

        $draft = $request->get('draft') == '1';

        if ($draft) {
            $query->where('is_published', false)
                ->where('user_id', Auth::id());
        }

        if (!$this->authUser->hasRole('admin')) {
            $query->where('user_id', $this->authUser->id)
                ->orWhere('is_published', true);
        }

        if ($selectedLanguage) {
            $query->where('locale', $selectedLanguage);
        } else {
            // By default look for stories in the same language as the user's
            $userLocale = $this->authUser->locale;
            $selectedLanguage = $userLocale;
            $query->where('locale', $userLocale);
        }

        $stories = $query->get();

        // Count words in the whole story. Cache this later
        $activities = Activity::where('subject_type', Story::class)->get();

        $stories->map(function ($story) use ($activities) {
            // Count words and pages
            $story->pagesCount = $story->pages->count();

            // Statistics
            $activity = $activities->where('subject_id', $story->id);
            $story->statistics = [
                'games_played'      => $activity->where('log_name', 'new_game')->count(),
                'games_reset'       => $activity->where('log_name', 'reset_game')->count(),
                'games_finished'    => $activity->where('log_name', 'end_game')->count(),
                'unique_players'    => Activity::where('subject_type', Story::class)
                                               ->where('log_name', 'new_game')
                                               ->where('subject_id', $story->id)
                                               ->distinct('causer_id')->count(),
            ];
        });

        // List stories in other languages
        $storiesLocales = Story::distinct('locale')->get('locale');

        return View::make('stories.list', [
            'user' => $this->authUser,
            'stories' => $stories,
            'storiesLocales' => $storiesLocales,
            'selectedLanguage' => !empty($selectedLanguage) ? $selectedLanguage : null
        ]);
    }
}
