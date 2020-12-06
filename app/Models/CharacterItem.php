<?php

namespace App\Models;

use App\Classes\Action;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CharacterItem extends Model
{
    // FIXME: why do I have to do that ??? item.use looks for character_items.......
    protected $table = 'character_item';

    protected $fillable = ['equipped_on'];

    public $timestamps = false;

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    /**
     * Use an item and apply all attached effects
     *
     * @return false|int
     * @throws \Exception
     */
    public function use()
    {
        $character = $this->item->story->currentCharacter();

        // If this is flagged Single Use, remove it
        // If the item is unique, flag it so it can't be used anymore
        if ($this->item->single_use && $this->item->is_unique) {
            $this->is_used = true;
            $this->save();
        } else {
            $this->delete();
        }


        // Apply the effects, if any
        $success = Action::applyEffects($character, $this->item);

        return $success;
    }
}
