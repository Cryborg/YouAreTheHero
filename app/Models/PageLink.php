<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageLink extends Model
{
    protected $table = "page_link";
    protected $guarded = ['id'];

    protected $keyType = 'string';

    public $timestamps = false;

    /**
     * Get the page.
     */
    public function pageFrom()
    {
        return $this->belongsTo(Page::class, 'page_from');
    }

    /**
     * Get the page.
     */
    public function pageTo()
    {
        return $this->belongsTo(Page::class, 'page_to');
    }
}
