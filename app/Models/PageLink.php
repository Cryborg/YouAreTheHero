<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageLink extends Model
{
    public $table = "page_link";
    public $guarded = ['id'];
    public $timestamps = false;
}
