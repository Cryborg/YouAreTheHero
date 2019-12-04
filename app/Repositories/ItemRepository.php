<?php

namespace App\Repositories;

use App\Models\Page;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class ItemRepository
{
    public function find($id)
    {
        return Cache::rememberForever('item_' . $id, function () use ($id) {
            return Page::findOrFail($id);
        });
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
