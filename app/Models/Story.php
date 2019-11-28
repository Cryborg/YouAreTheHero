<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    protected $fillable = ['title'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return mixed
     */
    public function genres()
    {
        $idsStoryGenre = StoryGenre::where('story_id', $this->id)->pluck('id');
        $aGenres = Genre::whereIn('id', $idsStoryGenre)->pluck('label', 'id')->toArray();

        return $aGenres;
    }
}
