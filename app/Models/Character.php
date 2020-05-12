<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
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

        $inventory = Inventory::where([
            'character_id' => $this->id,
        ])->get();
        $items = [];

        foreach ($inventory as $item) {
            $items[] = [
                'item' => Item::where('id', $item->item_id)->first(),
                'quantity' => $item['quantity'],
            ];
        }

        return $items;
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

    public function character_stats()
    {
        return $this->hasMany(CharacterStat::class)->with('field');
    }
}
