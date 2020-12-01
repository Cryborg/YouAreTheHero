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
 * App\Models\Action
 *
 * @property int $id
 * @property string $trigger_type
 * @property int $trigger_id
 * @property string $actionable_type
 * @property int $actionable_id
 * @property int $quantity
 * @property bool $unique
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $actionable
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $triggerable
 * @method static \Illuminate\Database\Eloquent\Builder|Action newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Action newQuery()
 * @method static \Illuminate\Database\Query\Builder|Action onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Action query()
 * @method static \Illuminate\Database\Eloquent\Builder|Action whereActionableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Action whereActionableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Action whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Action whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Action whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Action whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Action whereTriggerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Action whereTriggerType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Action whereUnique($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Action whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Action withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Action withoutTrashed()
 */
	class Action extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ActionCharacter
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ActionCharacter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActionCharacter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActionCharacter query()
 */
	class ActionCharacter extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Character
 *
 * @property int $id
 * @property string $name
 * @property string|null $genre
 * @property int $user_id
 * @property int $story_id
 * @property int $page_id
 * @property int $money
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Action[] $actions
 * @property-read int|null $actions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Field[] $fields
 * @property-read int|null $fields_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Item[] $items
 * @property-read int|null $items_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Location[] $locations
 * @property-read int|null $locations_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Page[] $pages
 * @property-read int|null $pages_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Person[] $people
 * @property-read int|null $people_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Riddle[] $riddles
 * @property-read int|null $riddles_count
 * @property-read \App\Models\Story $story
 * @method static \Illuminate\Database\Eloquent\Builder|Character newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Character newQuery()
 * @method static \Illuminate\Database\Query\Builder|Character onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Character query()
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereGenre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereMoney($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereStoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Character withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Character withoutTrashed()
 */
	class Character extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CharacterField
 *
 * @property-read \App\Models\Field $field
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterField query()
 */
	class CharacterField extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CharacterItem
 *
 * @property int $id
 * @property int $character_id
 * @property int $item_id
 * @property int $quantity
 * @property int $is_used
 * @property int $taken
 * @property-read \App\Models\Item $item
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterItem whereCharacterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterItem whereIsUsed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterItem whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterItem whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterItem whereTaken($value)
 */
	class CharacterItem extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CharacterLocation
 *
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterLocation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterLocation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterLocation query()
 */
	class CharacterLocation extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CharacterPage
 *
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterPage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterPage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterPage query()
 */
	class CharacterPage extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CharacterPerson
 *
 * @property int $id
 * @property int $character_id
 * @property int $person_id
 * @property string|null $first_name
 * @property string|null $last_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterPerson newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterPerson newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterPerson query()
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterPerson whereCharacterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterPerson whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterPerson whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterPerson whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterPerson whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterPerson wherePersonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterPerson whereUpdatedAt($value)
 */
	class CharacterPerson extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CharacterRiddle
 *
 * @property-read \App\Models\Riddle $riddle
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterRiddle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterRiddle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterRiddle query()
 */
	class CharacterRiddle extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Choice
 *
 * @property string $id
 * @property int|null $page_from
 * @property int|null $page_to
 * @property string $link_text
 * @property bool $hidden
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Page|null $pageFrom
 * @property-read \App\Models\Page|null $pageTo
 * @method static \Illuminate\Database\Eloquent\Builder|Choice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Choice newQuery()
 * @method static \Illuminate\Database\Query\Builder|Choice onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Choice query()
 * @method static \Illuminate\Database\Eloquent\Builder|Choice whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Choice whereHidden($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Choice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Choice whereLinkText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Choice wherePageFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Choice wherePageTo($value)
 * @method static \Illuminate\Database\Query\Builder|Choice withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Choice withoutTrashed()
 */
	class Choice extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Currency
 *
 * @property int $id
 * @property int $story_id
 * @property string $name
 * @property string|null $icon
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Currency newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Currency newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Currency query()
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereStoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereUpdatedAt($value)
 */
	class Currency extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Description
 *
 * @property int $id
 * @property int $page_id
 * @property string $keyword
 * @property string $description
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Page $page
 * @method static \Illuminate\Database\Eloquent\Builder|Description newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Description newQuery()
 * @method static \Illuminate\Database\Query\Builder|Description onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Description query()
 * @method static \Illuminate\Database\Eloquent\Builder|Description whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Description whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Description whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Description whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Description whereKeyword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Description wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Description whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Description withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Description withoutTrashed()
 */
	class Description extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Equipment
 *
 * @property int $id
 * @property int $story_id
 * @property string $slot
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereSlot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereStoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereUpdatedAt($value)
 */
	class Equipment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Field
 *
 * @property int $id
 * @property int $story_id
 * @property string $name
 * @property bool $hidden
 * @property int $min_value
 * @property int $max_value
 * @property int $start_value
 * @property int $order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Item[] $items
 * @property-read int|null $items_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Prerequisite[] $prerequisites
 * @property-read int|null $prerequisites_count
 * @property-read \App\Models\Story $story
 * @method static \Illuminate\Database\Eloquent\Builder|Field newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Field newQuery()
 * @method static \Illuminate\Database\Query\Builder|Field onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Field query()
 * @method static \Illuminate\Database\Eloquent\Builder|Field whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Field whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Field whereHidden($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Field whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Field whereMaxValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Field whereMinValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Field whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Field whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Field whereStartValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Field whereStoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Field whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Field withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Field withoutTrashed()
 */
	class Field extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\FieldItem
 *
 * @method static \Illuminate\Database\Eloquent\Builder|FieldItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FieldItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FieldItem query()
 */
	class FieldItem extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Genre
 *
 * @property int $id
 * @property string $label
 * @property bool $hidden
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Story[] $stories
 * @property-read int|null $stories_count
 * @method static \Illuminate\Database\Eloquent\Builder|Genre newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Genre newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Genre query()
 * @method static \Illuminate\Database\Eloquent\Builder|Genre whereHidden($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Genre whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Genre whereLabel($value)
 */
	class Genre extends \Eloquent {}
}

namespace App\Models\Inbox{
/**
 * App\Models\Inbox\Message
 *
 * @property int $id
 * @property int $user_id
 * @property int $thread_id
 * @property string $body
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Inbox\Participant[] $participants
 * @property-read int|null $participants_count
 * @property-read \App\Models\Inbox\Thread $thread
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Message newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Message newQuery()
 * @method static \Illuminate\Database\Query\Builder|Message onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Message query()
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereThreadId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Message withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Message withoutTrashed()
 */
	class Message extends \Eloquent {}
}

namespace App\Models\Inbox{
/**
 * App\Models\Inbox\Participant
 *
 * @property int $id
 * @property int $user_id
 * @property int $thread_id
 * @property string|null $seen_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Inbox\Thread $thread
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Participant inbox($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Participant newQuery()
 * @method static \Illuminate\Database\Query\Builder|Participant onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Participant query()
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereSeenAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereThreadId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Participant withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Participant withoutTrashed()
 */
	class Participant extends \Eloquent {}
}

namespace App\Models\Inbox{
/**
 * App\Models\Inbox\Thread
 *
 * @property mixed id
 * @property int $id
 * @property int $user_id
 * @property string|null $subject
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Inbox\Message[] $messages
 * @property-read int|null $messages_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $participants
 * @property-read int|null $participants_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $recipients
 * @property-read int|null $recipients_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Thread from($users)
 * @method static \Illuminate\Database\Eloquent\Builder|Thread newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Thread newQuery()
 * @method static \Illuminate\Database\Query\Builder|Thread onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Thread query()
 * @method static \Illuminate\Database\Eloquent\Builder|Thread seen()
 * @method static \Illuminate\Database\Eloquent\Builder|Thread to($users)
 * @method static \Illuminate\Database\Eloquent\Builder|Thread whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Thread whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Thread whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Thread whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Thread whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Thread whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Thread withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Thread withoutTrashed()
 */
	class Thread extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Item
 *
 * @property int $id
 * @property int $story_id
 * @property string|null $category
 * @property string $name
 * @property int $default_price
 * @property int $single_use
 * @property bool $is_unique
 * @property bool $is_throwable
 * @property float $size How much room it takes in the inventory.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Action[] $actions
 * @property-read int|null $actions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Character[] $characters
 * @property-read int|null $characters_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Field[] $fields
 * @property-read int|null $fields_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Page[] $pages
 * @property-read int|null $pages_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Prerequisite[] $prerequisites
 * @property-read int|null $prerequisites_count
 * @property-read \App\Models\Riddle $riddles
 * @property-read \App\Models\Story $story
 * @method static \Illuminate\Database\Eloquent\Builder|Item newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Item newQuery()
 * @method static \Illuminate\Database\Query\Builder|Item onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Item query()
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereDefaultPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereIsThrowable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereIsUnique($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereSingleUse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereStoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Item withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Item withoutTrashed()
 */
	class Item extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ItemPage
 *
 * @property int $id
 * @property int $item_id
 * @property int $page_id
 * @property int|null $quantity
 * @property int|null $price
 * @property int|null $character_id Only used when a character drops an item from his inventory.
 * @property-read \App\Models\Character|null $character
 * @property-read \App\Models\Item $item
 * @property-read \App\Models\Page $page
 * @method static \Illuminate\Database\Eloquent\Builder|ItemPage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemPage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemPage query()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemPage whereCharacterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemPage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemPage whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemPage wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemPage wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemPage whereQuantity($value)
 */
	class ItemPage extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Location
 *
 * @property int $id
 * @property int|null $parent_id
 * @property string $name
 * @property int|null $page_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Character[] $characters
 * @property-read int|null $characters_count
 * @property-read \App\Models\Page|null $page
 * @property-read \App\Models\Page|null $parent
 * @method static \Illuminate\Database\Eloquent\Builder|Location newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Location newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Location query()
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereUpdatedAt($value)
 */
	class Location extends \Eloquent {}
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
 * @property string $content
 * @property string|null $layout
 * @property bool $is_checkpoint
 * @property int $is_shop Whether the player can sell objects in this page.
 * @property string|null $ending_type If is_last, type of the ending, wether it is good, bad, a death, etc
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Action[] $actions
 * @property-read int|null $actions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Page[] $choices
 * @property-read int|null $choices_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Description[] $descriptions
 * @property-read int|null $descriptions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Item[] $items
 * @property-read int|null $items_count
 * @property-read \App\Models\Location|null $location
 * @property-read \Illuminate\Database\Eloquent\Collection|Page[] $parents
 * @property-read int|null $parents_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Report[] $reports
 * @property-read int|null $reports_count
 * @property-read \App\Models\Riddle|null $riddle
 * @property-read \App\Models\Story $story
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Action[] $triggers
 * @property-read int|null $triggers_count
 * @method static \Illuminate\Database\Eloquent\Builder|Page newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Page newQuery()
 * @method static \Illuminate\Database\Query\Builder|Page onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Page query()
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereEndingType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereIsCheckpoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereIsFirst($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereIsLast($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereIsShop($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereLayout($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereStoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Page withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Page withoutTrashed()
 */
	class Page extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Person
 *
 * @property int $id
 * @property int $story_id
 * @property int $order
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string $role
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Character[] $characters
 * @property-read int|null $characters_count
 * @method static \Illuminate\Database\Eloquent\Builder|Person newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Person newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Person query()
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereStoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereUpdatedAt($value)
 */
	class Person extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Prerequisite
 *
 * @property int $id
 * @property string $operator
 * @property int $quantity
 * @property string $prerequisiteable_type
 * @property int|null $prerequisiteable_id
 * @property int $page_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Page $page
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $prerequisiteable
 * @method static \Illuminate\Database\Eloquent\Builder|Prerequisite newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Prerequisite newQuery()
 * @method static \Illuminate\Database\Query\Builder|Prerequisite onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Prerequisite query()
 * @method static \Illuminate\Database\Eloquent\Builder|Prerequisite whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prerequisite whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prerequisite whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prerequisite whereOperator($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prerequisite wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prerequisite wherePrerequisiteableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prerequisite wherePrerequisiteableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prerequisite whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prerequisite whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Prerequisite withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Prerequisite withoutTrashed()
 */
	class Prerequisite extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Report
 *
 * @property int $id
 * @property int $user_id
 * @property int $page_id
 * @property string $error_type
 * @property string $comment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Page $page
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Report newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Report newQuery()
 * @method static \Illuminate\Database\Query\Builder|Report onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Report query()
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereErrorType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Report withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Report withoutTrashed()
 */
	class Report extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Riddle
 *
 * @property int $id
 * @property int $page_id
 * @property string|null $title
 * @property string $answer
 * @property string $type
 * @property string|null $target_page_text Text of the link giving the access to another page, if the riddle leads to somewhere else
 * @property int|null $target_page_id
 * @property int|null $item_id
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Character[] $characters
 * @property-read int|null $characters_count
 * @property-read \App\Models\Item|null $item
 * @property-read \App\Models\Page|null $page
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Prerequisite[] $prerequisites
 * @property-read int|null $prerequisites_count
 * @method static \Illuminate\Database\Eloquent\Builder|Riddle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Riddle newQuery()
 * @method static \Illuminate\Database\Query\Builder|Riddle onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Riddle query()
 * @method static \Illuminate\Database\Eloquent\Builder|Riddle whereAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Riddle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Riddle whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Riddle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Riddle whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Riddle wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Riddle whereTargetPageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Riddle whereTargetPageText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Riddle whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Riddle whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Riddle whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Riddle withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Riddle withoutTrashed()
 */
	class Riddle extends \Eloquent {}
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
 * @property bool $is_published
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User|null $author
 * @property-read \App\Models\Currency|null $currency
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Equipment[] $equipment
 * @property-read int|null $equipment_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Field[] $fields
 * @property-read int|null $fields_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Genre[] $genres
 * @property-read int|null $genres_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Item[] $items
 * @property-read int|null $items_count
 * @property-read \App\Models\StoryOption|null $options
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Page[] $pages
 * @property-read int|null $pages_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Person[] $people
 * @property-read int|null $people_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Report[] $reports
 * @property-read int|null $reports_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Story newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Story newQuery()
 * @method static \Illuminate\Database\Query\Builder|Story onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Story query()
 * @method static \Illuminate\Database\Eloquent\Builder|Story whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Story whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Story whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Story whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Story whereIsPublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Story whereLayout($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Story whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Story whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Story whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Story whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Story withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Story withoutTrashed()
 */
	class Story extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\StoryGenre
 *
 * @property int $story_id
 * @property int $genre_id
 * @method static \Illuminate\Database\Eloquent\Builder|StoryGenre newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StoryGenre newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StoryGenre query()
 * @method static \Illuminate\Database\Eloquent\Builder|StoryGenre whereGenreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoryGenre whereStoryId($value)
 */
	class StoryGenre extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\StoryOption
 *
 * @property int $id
 * @property int $story_id
 * @property bool $has_character Do we have to create a character for this story?
 * @property string|null $character_genre
 * @property bool $has_stats Do we show the stats creation page?
 * @property string $stat_attribution "player" means the player gives :points_to_share: points manually to his character. "dice" means it is done by throwing dice.
 * @property int $points_to_share Points to share amongst character stats
 * @property int $inventory_slots How much (virtual) slots there are in the inventory.
 * @property int $currency_amount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|StoryOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StoryOption newQuery()
 * @method static \Illuminate\Database\Query\Builder|StoryOption onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|StoryOption query()
 * @method static \Illuminate\Database\Eloquent\Builder|StoryOption whereCharacterGenre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoryOption whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoryOption whereCurrencyAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoryOption whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoryOption whereHasCharacter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoryOption whereHasStats($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoryOption whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoryOption whereInventorySlots($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoryOption wherePointsToShare($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoryOption whereStatAttribution($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoryOption whereStoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoryOption whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|StoryOption withTrashed()
 * @method static \Illuminate\Database\Query\Builder|StoryOption withoutTrashed()
 */
	class StoryOption extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Success
 *
 * @property int $id
 * @property string $title Translatable title: will be prefixed with "success."
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Success newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Success newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Success query()
 * @method static \Illuminate\Database\Eloquent\Builder|Success whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Success whereTitle($value)
 */
	class Success extends \Eloquent {}
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
 * @property string|null $password
 * @property string $locale
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $role
 * @property string|null $google_id
 * @property string|null $avatar
 * @property string|null $avatar_original
 * @property \Illuminate\Support\Carbon|null $valid_from
 * @property string|null $remember_token
 * @property bool $optin_system
 * @property bool $show_help
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Character[] $characters
 * @property-read int|null $characters_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Story[] $stories
 * @property-read int|null $stories_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Success[] $successes
 * @property-read int|null $successes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Inbox\Thread[] $threads
 * @property-read int|null $threads_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Query\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAvatarOriginal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGoogleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereOptinSystem($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereShowHelp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereValidFrom($value)
 * @method static \Illuminate\Database\Query\Builder|User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|User withoutTrashed()
 */
	class User extends \Eloquent implements \Illuminate\Contracts\Translation\HasLocalePreference {}
}

