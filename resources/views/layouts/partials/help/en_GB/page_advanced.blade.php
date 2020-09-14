<p>
    At the top of the page edition interface you have a few useful tabs.
</p>

<h3>@lang('page.tab_prerequisite')</h3>

<p>
    Sometimes you want the player to enter a room only if his/her character has a certain key, or enough Strength for example.
    To configure this, go to the <button class="btn btn-primary btn-sm text-white"><span class="icon-unlocking mr-2 text-white"></span>@lang('page.tab_prerequisite')</button> button
    to add a prerequisite.
</p>
<p>
    Tu peux ici choisir quel objet doit être présent dans l'inventaire, et la quantité que le joueur doit posséder. Car, si une seule clé
    est en général nécessaire pour ouvrir une porte, il peut être nécessaire de posséder plusieurs pièces d'or pour payer le garde interdisant
    le passage d'un pont.
</p>
@info(Cette option n'est bien sûr pas disponible sur la première page d'une histoire.)

<h3>Add a bonus/malus</h3>

<p>
    Imagine. The character falls into a pit. He loses one health point, and a piece of equipment.
    Click on the <button class="btn btn-primary btn-sm text-white"><span class="icon-unlocking mr-2 text-white"></span>@lang('page.tab_bonus')</button> button to set this up.
</p>

<h3>Add items to pick up</h3>

<p>
    Click on <button class="btn btn-primary btn-sm text-white"><span class="icon-chest mr-2 text-white"></span>@lang('page.tab_items')</button> to add
    an item on the page. The player will then be able to pick it up if he/she wants.
</p>
<p>
    If no item has been created yet, you can do it in the same popup.
</p>
<p>
    One thing to know: when you create an item, you can give it a price. This is the item's default price. But if you place it
    on a page, you can specify another price. 0 means the character can take it freely. More than 0 means that the character buys it.
    This can be useful in shops for example, of when meeting a merchant <a tabindex="0" role="button" data-trigger="hover" data-placement="top" data-toggle="popover" title="" data-content="<b>N</b>on <b>P</b>laying <b>C</b>haracter. Character not controlled by the player." data-original-title="NPC"><span class="icon-eye text-lightgrey mr-1"></span>NPC</a>.
</p>


<h3>Add a riddle</h3>

<p>
    A safe to open? A computer login? A magical door? These are only a few examples but you, as a writer, will need the character
    to enter a password or whatever code. This is where the <button class="btn btn-primary btn-sm text-white"><span class="icon-jigsaw-piece mr-2 text-white"></span>@lang('page.tab_riddle')</button> tab comes in.
</p>
<p>
    <img src="{{ asset('img/screenshots/riddle_popup.png') }}" class="shadow img-fluid mb-4">
</p>
<p>
    Enter the answer of the riddle, and the item he/she will win. If you don't want to give an item, no problem! You can redirect the
    character to another page.
</p>
