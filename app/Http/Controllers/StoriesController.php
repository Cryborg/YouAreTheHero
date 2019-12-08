<?php

namespace App\Http\Controllers;

use App\Models\Story;
use App\Models\User;
use http\Client\Request;use Illuminate\Support\Facades\Cache;use Illuminate\Support\Facades\Session;use Yajra\DataTables\DataTables;

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

        return view('stories.list');
    }

    public function listDraft()
    {
        // Delete old story session
        Session::remove('story');

        return view('stories.list', ['draft' => true]);
    }

    /**
     * Fill the Datatables with stories
     *
     * @param bool $draft
     *
     * @return mixed
     * @throws \Exception
     */
    public function ajaxList(\Illuminate\Http\Request $request)
    {
        $query = Story::select(['id','title','description','user_id','locale','created_at']);

        $draft = $request->get('draft') == '1';
        $cacheKey = 'stories.list';

        if ($draft) {
            $query->where('is_published', false);
            $cacheKey = 'stories.list.draft';
        } else {
            $query->where('is_published', true);
        }

        $stories = Cache::remember($cacheKey, 60, function () use ($query) {
            return $query->get();
        });

        $stories = $stories->map(function ($value, $key) {
            $user = Cache::rememberForever('user.' . $value['user_id'], function() use ($value) {
                return User::where('id', $value['user_id'])->first();
            });
            $name = $user->first_name . ' ' . $user->last_name;
            $value['user_id'] = $name;
            $value['genres'] = implode(', ', $value->genres());
            return $value;
        });

        return DataTables::of($stories)->make();
    }
}
