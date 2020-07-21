<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Choice extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $keyType = 'string';

    public $timestamps = false;

    /**
     * Get the page.
     */
    public function pageFrom()
    {
        return $this->belongsTo(Page::class, 'page_from', 'id');
    }

    /**
     * Get the page.
     */
    public function pageTo()
    {
        return $this->belongsTo(Page::class, 'page_to', 'id');
    }
}
