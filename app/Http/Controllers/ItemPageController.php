<?php

namespace App\Http\Controllers;

use App\Models\ItemPage;
use App\Models\Page;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ItemPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
}
