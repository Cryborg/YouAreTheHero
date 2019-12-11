<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class itemsPage extends Model
{
    protected $guarded = ['id'];

    public $timestamps = false;

    protected $table = 'items_pages';
}
