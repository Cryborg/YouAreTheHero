<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class ItemPage extends Model
{
    use PresentableTrait;

    protected $guarded    = ['id'];

    protected $table      = 'item_page';

    public    $timestamps = false;

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function character()
    {
        return $this->belongsTo(Character::class);
    }
}
