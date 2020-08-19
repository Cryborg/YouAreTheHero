<?php

namespace App\Models;

use App\Classes\Action;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CharacterItem extends Model
{
    //protected $fillable = ['character_id', 'item_id'];

    protected $table = 'character_item';

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
        $success = false;

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
