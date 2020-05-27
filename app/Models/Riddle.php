<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Riddle extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];
    public $timestamps = false;

    private $isRiddleSolved = null;

    public function page()
    {
        return $this->belongsTo(Page::class, 'target_page_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function character()
    {
        return $this->belongsToMany(Character::class);
    }

    public function isSolved()
    {
        if ($this->isRiddleSolved === null) {
            $this->isRiddleSolved = $this->character()->count() > 0;
        }

        return $this->isRiddleSolved;
    }

    public function prerequisites()
    {
        return $this->morphMany(Prerequisite::class, 'prerequisiteable');
    }

}
