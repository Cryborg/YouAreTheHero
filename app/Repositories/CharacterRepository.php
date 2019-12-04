<?php

namespace App\Repositories;

use App\Models\Page;
use Illuminate\Support\Facades\Cache;

class PageRepository
{
    public function find($id)
    {
        return Cache::rememberForever('page_' . $id, function () use ($id) {
            return Page::findOrFail($id);
        });
    }

    public function findWith(array $data)
    {
        $query = Page::where($data);

        return Cache::remember(md5($query->toSql()), 1440, function () use ($query) {
            return $query->get();
        });
    }

    public function findOneWith(array $data)
    {
        $query = Page::where($data);

        return Cache::remember(md5($query->toSql()), 1440, function () use ($query) {
            return $query->first();
        });
    }
}
