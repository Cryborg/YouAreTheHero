<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();

    }

    public function inventory()
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

    public function addMoney($amount)
    {
        $this->money += $amount;
        $this->save();
    }

    public function spendMoney($amount)
    {
        if ($this->money - $amount >= 0) {
            $this->money -= $amount;
            $this->save();

            return true;
        }

        return false;
    }
}
