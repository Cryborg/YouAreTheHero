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
    }

    /**
     * @return array
     */
    public function inventory(): array
    {
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

    public function stats()
    {
        return $this->hasMany(Stat::class);
    }
}
