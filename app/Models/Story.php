<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    protected $fillable = ['title'];

    /**
     * Get the pages.
     */
    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    /**
     * Get the genres.
     */
    public function genres()
    {
        return $this->hasMany(Genre::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
