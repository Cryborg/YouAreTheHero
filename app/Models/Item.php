<?php

namespace App\Models;

use App\Classes\Action;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;
use Laracasts\Presenter\PresentableTrait;
use App\Presenters\ItemPresenter;

class Item extends Model
{
    use PresentableTrait;
    use SoftDeletes;

    protected $presenter = ItemPresenter::class;

    protected $guarded   = ['id'];

    protected $with = ['effects'];

    protected $casts     = [
        'effects'   => 'array',
        'is_unique' => 'boolean',
        'size'      => 'float',
        'is_used'   => 'boolean',
    ];

    public function getIsUniqueAttribute($value)
    {
        if ($value === 1) {
            return trans('common.yes');
        }

        return trans('common.no');
    }

    public function setIsUniqueAttribute($value): int
    {
        if ($value === trans('common.yes')) {
            return 1;
        }

        return 0;
    }

    public function getSingleUseAttribute($value)
    {
        if ($value === 1) {
            return trans('common.yes');
        }

        return trans('common.no');
    }

    public function setSingleUseAttribute($value): int
    {
        if ($value === trans('common.yes')) {
            return 1;
        }

        return 0;
    }

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
        return $this->belongsToMany(Page::class);
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

    /**
     * Don't know why I have to do this.... @foreach($item->effects) did not work
     * in modal_list_items.blade.php...
     *
     * @return \Illuminate\Support\Collection
     */
    public function effects_list()
    {
        $allEffects = collect();

        $this->effects()->each(static function ($effect) use ($allEffects) {
            $allEffects->push($effect);
        });

        return $allEffects;
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

//        if ($this->default_price > 0) {
//            $character->addMoney($this->default_price);
//        }

        // If this is flagged Single Use, check if it is the last item in the player's inventory
        // Then subtract one, or remove it
        if ($this->single_use) {
            $thisItem = $character->items()->where('item_id', $this->id)->first()->pivot;

            if ($thisItem->quantity > 1) {
                $thisItem->quantity--;
                $success = $thisItem->save();
            } else {
                $success = $character->items()->detach($this);
            }
        }

        // If the item is unique, flag it so it can't be used anymore
        if ($this->is_unique) {
            $success = $character->items()->updateExistingPivot($this, [
                'is_used' => true
            ]);
        }

        // Apply the effects, if any
        Action::applyEffects($character, $this);

        return $success;
    }
}
