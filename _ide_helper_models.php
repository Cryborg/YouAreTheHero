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
 * App\Models\Field
 *
 * @property int $id
 * @property int $story_id
 * @property string $name
 * @property string $short_name
 * @property int $min_value
 * @property int $max_value
 * @property int $start_value
 * @property int $order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Prerequisite[] $prerequisites
 * @property-read int|null $prerequisites_count
 * @property-read \App\Models\Story $story
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Field newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Field newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Field onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Field query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Field whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Field whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Field whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Field whereMaxValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Field whereMinValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Field whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Field whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Field whereShortName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Field whereStartValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Field whereStoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Field whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Field withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Field withoutTrashed()
 */
	class Field extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CharacterField
 *
 * @property-read \App\Models\Field $field
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CharacterField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CharacterField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CharacterField query()
 */
	class CharacterField extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ItemPage
 *
 * @property int $id
 * @property int $item_id
 * @property int $page_id
 * @property string $verb
 * @property int $quantity
 * @property int|null $price
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Item $item
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemPage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemPage newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ItemPage onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemPage query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemPage whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemPage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemPage whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemPage wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemPage wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemPage whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemPage whereVerb($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ItemPage withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ItemPage withoutTrashed()
 */
	class ItemPage extends \Eloquent {}
}

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
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $actionable
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $trigger
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Action newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Action newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Action onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Action query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Action whereActionableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Action whereActionableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Action whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Action whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Action whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Action whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Action whereTriggerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Action whereTriggerType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Action whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Action withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Action withoutTrashed()
 */
	class Action extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Character
 *
 * @property int $id
 * @property string $name
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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Page[] $pages
 * @property-read int|null $pages_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Riddle[] $riddles
 * @property-read int|null $riddles_count
 * @property-read \App\Models\Story $story
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Character newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Character newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Character onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Character query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Character whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Character whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Character whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Character whereMoney($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Character whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Character wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Character whereStoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Character whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Character whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Character withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Character withoutTrashed()
 */
	class Character extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Genre
 *
 * @property int $id
 * @property string $label
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Story[] $stories
 * @property-read int|null $stories_count
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
 * App\Models\CharacterItem
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CharacterItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CharacterItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CharacterItem query()
 */
	class CharacterItem extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\StoryOption
 *
 * @property int $id
 * @property int $story_id
 * @property int $has_character Do we have to create a character for this story?
 * @property int $has_stats Do we show the stats creation page?
 * @property string $stat_attribution "player" means the player gives :points_to_share: points manually to his character. "dice" means it is done by throwing dice.
 * @property int $points_to_share Points to share amongst character stats
 * @property int $inventory_slots How much (virtual) slots there are in the inventory.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StoryOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StoryOption newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\StoryOption onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StoryOption query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StoryOption whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StoryOption whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StoryOption whereHasCharacter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StoryOption whereHasStats($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StoryOption whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StoryOption whereInventorySlots($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StoryOption wherePointsToShare($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StoryOption whereStatAttribution($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StoryOption whereStoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StoryOption whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\StoryOption withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\StoryOption withoutTrashed()
 */
	class StoryOption extends \Eloquent {}
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
 * @property bool $single_use
 * @property float $size How much room it takes in the inventory.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ItemPage[] $actions
 * @property-read int|null $actions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Character[] $characters
 * @property-read int|null $characters_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Effect[] $effects
 * @property-read int|null $effects_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Page[] $pages
 * @property-read int|null $pages_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Prerequisite[] $prerequisites
 * @property-read int|null $prerequisites_count
 * @property-read \App\Models\Story $story
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereDefaultPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereSingleUse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereStoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereUpdatedAt($value)
 */
	class Item extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Effect
 *
 * @property int $id
 * @property int $item_id
 * @property int $field_id
 * @property string $operator
 * @property int $quantity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Field $field
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Item[] $item
 * @property-read int|null $item_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Effect newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Effect newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Effect onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Effect query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Effect whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Effect whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Effect whereFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Effect whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Effect whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Effect whereOperator($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Effect whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Effect whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Effect withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Effect withoutTrashed()
 */
	class Effect extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Prerequisite
 *
 * @property int $id
 * @property int $quantity
 * @property string $prerequisiteable_type
 * @property int $prerequisiteable_id
 * @property int $page_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $prerequisiteable
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prerequisite newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prerequisite newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Prerequisite onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prerequisite query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prerequisite whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prerequisite whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prerequisite whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prerequisite wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prerequisite wherePrerequisiteableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prerequisite wherePrerequisiteableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prerequisite whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prerequisite whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Prerequisite withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Prerequisite withoutTrashed()
 */
	class Prerequisite extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CharacterPage
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CharacterPage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CharacterPage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CharacterPage query()
 */
	class CharacterPage extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Choice
 *
 * @property string $id
 * @property \App\Models\Page|null $page_from
 * @property \App\Models\Page|null $page_to
 * @property string $link_text
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Page|null $pageFrom
 * @property-read \App\Models\Page|null $pageTo
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Choice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Choice newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Choice onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Choice query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Choice whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Choice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Choice whereLinkText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Choice wherePageFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Choice wherePageTo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Choice withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Choice withoutTrashed()
 */
	class Choice extends \Eloquent {}
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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Character[] $character
 * @property-read int|null $character_count
 * @property-read \App\Models\Item|null $item
 * @property-read \App\Models\Page|null $page
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Prerequisite[] $prerequisites
 * @property-read int|null $prerequisites_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Riddle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Riddle newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Riddle onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Riddle query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Riddle whereAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Riddle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Riddle whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Riddle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Riddle whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Riddle wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Riddle whereTargetPageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Riddle whereTargetPageText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Riddle whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Riddle whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Riddle whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Riddle withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Riddle withoutTrashed()
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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Field[] $fields
 * @property-read int|null $fields_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Genre[] $genres
 * @property-read int|null $genres_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Item[] $items
 * @property-read int|null $items_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Page[] $pages
 * @property-read int|null $pages_count
 * @property-read \App\Models\StoryOption|null $story_options
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Story newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Story newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Story onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Story query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Story whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Story whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Story whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Story whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Story whereIsPublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Story whereLayout($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Story whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Story whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Story whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Story whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Story withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Story withoutTrashed()
 */
	class Story extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ActionCharacter
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ActionCharacter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ActionCharacter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ActionCharacter query()
 */
	class ActionCharacter extends \Eloquent {}
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Description newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Description newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Description onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Description query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Description whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Description whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Description whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Description whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Description whereKeyword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Description wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Description whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Description withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Description withoutTrashed()
 */
	class Description extends \Eloquent {}
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
 * @property string $role
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Story[] $stories
 * @property-read int|null $stories_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRole($value)
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
 * @property string $content
 * @property string|null $layout
 * @property bool $is_checkpoint
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Action[] $actions
 * @property-read int|null $actions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Page[] $choices
 * @property-read int|null $choices_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Description[] $descriptions
 * @property-read int|null $descriptions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Item[] $items
 * @property-read int|null $items_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Page[] $parents
 * @property-read int|null $parents_count
 * @property-read \App\Models\Riddle|null $riddle
 * @property-read \App\Models\Story $story
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Action[] $trigger
 * @property-read int|null $trigger_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereIsCheckpoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereIsFirst($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereIsLast($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereLayout($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereStoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page withoutTrashed()
 */
	class Page extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CharacterRiddle
 *
 * @property-read \App\Models\Riddle $riddle
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CharacterRiddle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CharacterRiddle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CharacterRiddle query()
 */
	class CharacterRiddle extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\StoryGenre
 *
 * @property int $story_id
 * @property int $genre_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StoryGenre newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StoryGenre newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\StoryGenre onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StoryGenre query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StoryGenre whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StoryGenre whereGenreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StoryGenre whereStoryId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\StoryGenre withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\StoryGenre withoutTrashed()
 */
	class StoryGenre extends \Eloquent {}
}

