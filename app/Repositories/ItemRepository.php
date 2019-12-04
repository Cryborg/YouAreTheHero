<?php

namespace App\Repositories;

use App\Models\Page;
use Illuminate\Support\Facades\Cache;

class CharacterRepository extends Repository
{
    public function find($id)
    {
        return Cache::rememberForever('character_' . $id, function () use ($id) {
            return Page::findOrFail($id);
        });
    }
}
