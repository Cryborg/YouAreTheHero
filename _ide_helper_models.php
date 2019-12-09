<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\PageLink
 *
 * @property int $id
 * @property string|null $page_from
 * @property string|null $page_to
 * @property string $link_text
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageLink newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageLink newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageLink query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageLink whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageLink whereLinkText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageLink wherePageFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageLink wherePageTo($value)
 */
	class PageLink extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Character
 *
 * @property int $id
 * @property string $name
 * @property int $user_id
 * @property int $story_id
 * @property string $page_id
 * @property int $money
 * @property array|null $sheet
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Checkpoint[] $checkpoints
 * @property-read int|null $checkpoints_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Character newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Character newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Character query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Character whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Character whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Character whereMoney($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Character whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Character wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Character whereSheet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Character whereStoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Character whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Character whereUserId($value)
 */
	class Character extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Genre
 *
 * @property int $id
 * @property string $label
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Genre newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Genre newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Genre query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Genre whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Genre whereLabel($value)
 */
	class Genre extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Inventory
 *
 * @property int $id
 * @property int $character_id
 * @property int $item_id
 * @property int $quantity
 * @property int $used
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Inventory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Inventory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Inventory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Inventory whereCharacterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Inventory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Inventory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Inventory whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Inventory whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Inventory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Inventory whereUsed($value)
 */
	class Inventory extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Item
 *
 * @property int $id
 * @property string $name
 * @property int $default_price
 * @property int $story_id
 * @property array|null $effects
 * @property bool $single_use
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereDefaultPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereEffects($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereSingleUse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereStoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereUpdatedAt($value)
 */
	class Item extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UniqueItemsUsed
 *
 * @property int $id
 * @property int $character_id
 * @property int $item_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UniqueItemsUsed newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UniqueItemsUsed newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UniqueItemsUsed query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UniqueItemsUsed whereCharacterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UniqueItemsUsed whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UniqueItemsUsed whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UniqueItemsUsed whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UniqueItemsUsed whereUpdatedAt($value)
 */
	class UniqueItemsUsed extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Story
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $user_id
 * @property string $locale
 * @property string $layout
 * @property array|null $sheet_config
 * @property int $is_published
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Page[] $pages
 * @property-read int|null $pages_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Story newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Story newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Story query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Story whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Story whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Story whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Story whereIsPublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Story whereLayout($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Story whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Story whereSheetConfig($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Story whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Story whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Story whereUserId($value)
 */
	class Story extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $locale
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Story[] $stories
 * @property-read int|null $stories_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUsername($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Page
 *
 * @property string $id
 * @property int $story_id
 * @property bool $is_first
 * @property bool $is_last
 * @property string|null $title
 * @property string $description
 * @property array|null $items
 * @property array|null $prerequisites
 * @property string|null $layout
 * @property bool $is_checkpoint
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Story $story
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereIsCheckpoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereIsFirst($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereIsLast($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereItems($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereLayout($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page wherePrerequisites($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereStoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereUpdatedAt($value)
 */
	class Page extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\StoryGenre
 *
 * @property int $id
 * @property int $story_id
 * @property int $genre_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StoryGenre newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StoryGenre newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StoryGenre query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StoryGenre whereGenreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StoryGenre whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StoryGenre whereStoryId($value)
 */
	class StoryGenre extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Checkpoint
 *
 * @property int $id
 * @property int $character_id
 * @property string $page_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Character $character
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Checkpoint newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Checkpoint newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Checkpoint query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Checkpoint whereCharacterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Checkpoint whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Checkpoint whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Checkpoint wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Checkpoint whereUpdatedAt($value)
 */
	class Checkpoint extends \Eloquent {}
}

