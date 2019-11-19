<?php

namespace App\Http\Controllers;

use App\Models\Story;
use Yajra\DataTables\DataTables;

class StoriesController extends Controller
{
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

        return DataTables::of($stories)->make();
    }
}
