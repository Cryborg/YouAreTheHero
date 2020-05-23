<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Description extends Model
{
    protected $fillable = ['keyword', 'description'];

    public $timestamps = false;

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
