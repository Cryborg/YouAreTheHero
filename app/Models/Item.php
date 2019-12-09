<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $casts = [
        'effects' => 'array',
        'single_use' => 'boolean',
    ];

    /**
     * Get the pageLinks.
     */
    public function pages()
    {
        return $this->belongsToMany(Page::class);
    }
}
