<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Riddle extends Model
{

    protected $guarded = ['id'];
    public $timestamps = false;

    private $isRiddleSolved = null;

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function answered_riddle()
    {
        return $this->hasOne(CharacterRiddle::class);
    }

    public function isSolved()
    {
        if ($this->isRiddleSolved === null) {
            $this->isRiddleSolved = $this->answered_riddle()->count() > 0;
        }

        return $this->isRiddleSolved;
    }
}
