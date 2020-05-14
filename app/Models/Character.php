<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laracasts\Presenter\PresentableTrait;
use App\Presenters\CharacterPresenter;

class Character extends Model
{
    use SoftDeletes;
    use PresentableTrait;

    protected $presenter = CharacterPresenter::class;

    protected $guarded = ['id'];


    public static function boot()
    {
        parent::boot();

        //static::deleting(function($character) { // before delete() method call this
          //  $character->inventory()->delete();
            // do the rest of the cleanup...
        //});
    }

    public function inventory()
    {
        return $this->hasMany(Inventory::class)->with('item');
    }

    /**
     * @param $amount
     *
     * @return bool
     */
    public function addMoney($amount): bool
    {
        $this->money += $amount;
        return $this->save();
    }

    /**
     * @param $amount
     *
     * @return bool
     */
    public function spendMoney($amount): bool
    {
        if ($this->money - $amount >= 0) {
            $this->money -= $amount;
            return $this->save();
        }

        return false;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function checkpoints(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Checkpoint::class);
    }

    public function fields()
    {
        return $this->belongsToMany(Field::class)->withPivot('value');
    }

    public function riddles()
    {
        return $this->hasMany(Riddle::class);
    }
}
