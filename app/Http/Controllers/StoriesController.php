<?php

namespace App\Http\Controllers;

use App\Models\Story;
use App\Models\User;
use Yajra\DataTables\DataTables;

class StoriesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function list()
    {
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
        $stories = Story::select(['id','title','description','user_id','locale','created_at']);

        $stories = $stories->get()->map(function ($value, $key) {
            $user = User::where('id', $value['user_id'])->first();
            $name = $user->first_name . ' ' . $user->last_name;
            $value['user_id'] = $name;
            return $value;
        });

        return DataTables::of($stories)->make();
    }
}
