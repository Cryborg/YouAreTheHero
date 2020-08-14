<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laracasts\Presenter\PresentableTrait;
use App\Presenters\ItemPresenter;

class Item extends Model
{
    use PresentableTrait;
    use SoftDeletes;

    protected $presenter = ItemPresenter::class;

    protected $guarded   = ['id'];

    protected $casts     = [
        'effects'   => 'array',
        'is_unique' => 'boolean',
        'size'      => 'float',
        'is_used'   => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
    }

    /**
     * Get the pages
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function pages()
    {
        return $this->belongsToMany(Page::class, 'actions');
    }

    /**
     * Get actions that contain this item
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function actions()
    {
        return $this->belongsToMany(ItemPage::class);
    }

    public function story()
    {
        return $this->belongsTo(Story::class);
    }

    public function prerequisites()
    {
        return $this->morphMany(Prerequisite::class, 'prerequisiteable');
    }

    public function effects()
    {
        return $this->hasMany(Effect::class)->with('field');
    }

    public function characters()
    {
        return $this->belongsToMany(Character::class);
    }

    public function sellingPrice()
    {
        // Use the price of the item
        if ($this->pivot->price === -1) {
            return $this->default_price;
        }

        return $this->pivot->price;
    }

    public function use()
    {
        $success = false;

        /** @var \App\Models\Character $character */
        $character = $this->story->currentCharacter();

        if ($this->default_price > 0) {
            $character->addMoney($this->default_price);
        }

        if ($this->single_use) {
            $thisItem = $character->items()->where('item_id', $this->id)->first()->pivot;

            if ($thisItem->quantity > 1) {
                $thisItem->quantity--;
                $success = $thisItem->save();
            } else {
                $success = $character->items()->detach($this);
            }
        }

        if ($this->is_unique) {
            $success = $character->items()->updateExistingPivot($this, [
                'is_used' => true
            ]);
        }

        return $success;
    }
}
