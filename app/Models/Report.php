<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $with = ['user', 'page'];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
