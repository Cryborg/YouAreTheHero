<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Laracasts\Presenter\PresentableTrait;
use App\Presenters\CharacterPresenter;

class Character extends Model
{
    use SoftDeletes;
    use PresentableTrait;

    protected $presenter = CharacterPresenter::class;

    protected $guarded   = ['id'];

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($character) { // before delete() method call this
            $character->items()->detach();
            $character->riddles()->detach();
            $character->fields()->detach();
            $character->pages()->detach();
        });
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

    public static function createNewForStory(Story $story)
    {
        $storyOption = $story->story_options();

        // If no option needs to be set, create an unnamed character
        if ($story->story_options->has_character === false || $storyOption->count() === 0) {
            Auth::user()->characters()->create([
               'name'     => 'Unnamed',
               'user_id'  => Auth::id(),
               'story_id' => $story->id,
               'page_id'  => $story->getCurrentPage()->id,
           ]);

            // Log this new game
            activity()
                ->useLog('new_game')
                ->performedOn($story)
                ->log('New game started');

            return Redirect::route('story.play', [
                'story' => $story->id,
            ]);
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pages(): \Illuminate\Database\Eloquent\Relations\belongsToMany
    {
        return $this->belongsToMany(Page::class);
    }

    public function fields(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Field::class)->withPivot('value');
    }

    public function riddles()
    {
        return $this->belongsToMany(Riddle::class);
    }

    public function items(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Item::class)->withPivot(['quantity', 'is_used']);
    }

    public function actions()
    {
        return $this->belongsToMany(Action::class);
    }

    public function story()
    {
        return $this->belongsTo(Story::class);
    }


}
