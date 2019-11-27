<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Savegame extends Model
{
    protected $fillable = ['character_id', 'page_id'];
    protected $primaryKey = 'character_id';
}
