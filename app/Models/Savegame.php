<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Savegame extends Model
{
    protected $fillable = ['user_id', 'story_id', 'page_id'];
    protected $primaryKey = 'user_id';
}
