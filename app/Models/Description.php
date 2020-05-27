<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Description extends Model
{
    use SoftDeletes;

    protected $fillable = ['keyword', 'description'];

    public $timestamps = false;

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
