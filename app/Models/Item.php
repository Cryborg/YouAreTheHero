<?php

namespace App\Models;

use App\Classes\Action;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Laracasts\Presenter\PresentableTrait;
use App\Presenters\ItemPresenter;

class Item extends Model
{
    use PresentableTrait;
    use SoftDeletes;

    protected $presenter = ItemPresenter::class;

    protected $guarded   = ['id'];

    protected $with      = ['effects'];

    protected $casts     = [
        'effects'      => 'array',
        'is_throwable' => 'boolean',
        'is_unique'    => 'boolean',
        'is_used'      => 'boolean',
        'size'         => 'float',
    ];

    protected static function boot()
    {
        parent::boot();
    }

    public function isUsed()
    {
        $notInPages = $this->pages()->count() === 0;
        $notInActions = $this->actions()->count() === 0;
        $notInPrerequisites = $this->prerequisites()->count() === 0;
        $notInRiddles = $this->riddles()->count() === 0;

        return !($notInPages && $notInActions && $notInPrerequisites && $notInRiddles);
    }

    /**
     * Get the pages
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function pages(): BelongsToMany
    {
        return $this->belongsToMany(Page::class);
    }

    /**
     * Get actions that contain this item
     */
    public function actions()
    {
        return $this->morphMany(\App\Models\Action::class, 'actionable');
    }

    public function story(): BelongsTo
    {
        return $this->belongsTo(Story::class);
    }

    public function prerequisites(): MorphMany
    {
        return $this->morphMany(Prerequisite::class, 'prerequisiteable');
    }

    public function riddles()
    {
        return $this->belongsTo(Riddle::class);
    }

    /**
     * FIXME: Don't know why I have to do this.... @foreach($item->effects) did not work
     *        in modal_list_items.blade.php...
     *
     * @return \Illuminate\Support\Collection
     */
    public function effects_list(): Collection
    {
        $allEffects = collect();

        $this->effects()
             ->each(static function ($effect) use ($allEffects) {
                 $allEffects->push($effect);
             });

        return $allEffects;
    }

    public function effects(): HasMany
    {
        return $this->hasMany(Effect::class)
                    ->with('field');
    }

    public function characters(): BelongsToMany
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

    /**
     * Take an item and put it in the inventory
     *
     * @param \App\Models\Page $page
     *
     * @return array
     */
    public function take(Page $page): array
    {
        $isOk    = false;
        $message = null;

        $character = $this->story->currentCharacter();

        // Check if there is enough room in the character's inventory
        if (Action::hasRoomLeftInInventory($character, $this)) {
            // Check if the item must be bought
            $item = $page->items()->wherePivot('item_id', $this->id)->first();

            if ($item->pivot->price > 0) {
                if ($character->money >= $item->pivot->price) {
                    $character->money -= $item->pivot->price;
                    $character->save();
                } else {
                    return [
                        'success' => false,
                        'message' => trans('character.not_enough_money'),
                        'type'    => 'save',
                    ];
                }
            }

            // Add the item to the inventory
            $character->items()
                      ->attach($this->id);

            $isOk = true;
        } else {
            $message = trans('inventory.no_more_room');
        }

        return [
            'success' => $isOk,
            'message' => $message,
            'type'    => 'save',
        ];
    }

    /**
     * Remove the item from the inventory.
     */
    public function throwAway(): void
    {
        $character = $this->story->currentCharacter();

        $character->items()
                  ->detach($this);
    }

    public function single_use_as_text()
    {
        return $this->booleanToText($this->single_use);
    }

    public function is_unique_as_text()
    {
        return $this->booleanToText($this->is_unique);
    }

    public function is_throwable_as_text()
    {
        return $this->booleanToText($this->is_throwable);
    }

    private function booleanToText($value)
    {
        switch ($value) {
            case true:
                return trans('common.yes');
            case false:
                return trans('common.no');
        }
    }
}
