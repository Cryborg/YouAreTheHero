<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Riddle extends Model
{

    protected $guarded = ['id'];
    public $timestamps = false;

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
