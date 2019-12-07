<?php

namespace App\Http\Controllers;

use App\Models\Story;
use App\Models\User;
use Illuminate\Support\Facades\Cache;use Illuminate\Support\Facades\Session;use Yajra\DataTables\DataTables;

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

    /**
     * Fill the Datatables with stories
     *
     * @return mixed
     * @throws \Exception
     */
    public function ajax_list()
    {
        $stories = Cache::remember('stories.list', 60, function () {
            return  Story::select(['id','title','description','user_id','locale','created_at'])
                         ->where('is_published', true)
                         ->get();
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
