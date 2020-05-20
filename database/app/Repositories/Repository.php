<?php

namespace App\Repositories;

use App\Models\Page;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Repository
{
    // model property on class instances
    protected $model;

    // Constructor to bind model to repo
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function findWith(array $data)
    {
        $query = Page::where($data);

        return Cache::remember(md5($query->toSql()), Config::get('app.story.cache_ttl'), function () use ($query) {
            return $query->get();
        });
    }

    public function findOneWith(array $data)
    {
        $query = Page::where($data);

        return Cache::remember(md5($query->toSql()), Config::get('app.story.cache_ttl'), function () use ($query) {
            return $query->first();
        });
    }
}
