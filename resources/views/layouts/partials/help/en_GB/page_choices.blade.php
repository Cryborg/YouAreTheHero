<p>
    Choices are links at the end of a page, leading to another page.
</p>
<p>
    At the top of the page you can find the <button class="btn btn-primary text-white"><span class="icon-choice mr-2 text-white"></span>@lang('page.add_choice')</button> button. Clicking on it opens a pretty simple popup window.
</p>

<h4>@lang('page.existing_page')</h4>

<p>
    If you want to link to an already existing page, choose it in this dropdown list. This contains the title to all available
    pages you can link to. Of course you won't see the page you are on, or the ones already linked to it.
</p>

<h4>Link to a new page</h4>

<p>
    Most of the time though you will need to link to a new page. Don't select anything in the dropdown list in order to do this,
    just fill in the <div class="false-input d-inline">@lang('page.link_text')</div> field.
</p>
<p>
    This text will then appear at the bottom of the page and the player will be able to click on it (except if you put
    prerequisites on it of course). <b>This is not necessarily the title of the linked page!</b>. This one will be set at next step,
    when you edit the page itself.
</p>
<p>
    Let's take an example: if you create a link and write <div class="false-input d-inline">Let's go!</div> in this field,
    it may link to a page whose title may be "On the road again".
</p>

<h4>Graphical tree</h4>

<p>
    On the right half side of the screen stands the graphical tree, representing your story. You see the different pages,
    the embranchments leading to other pages, the text of the choice, and other useful things. You can click a page to edit it,
    or even edit link texts by clicking on their <span class="icon-fountain-pen"></span> icon.
</p>
<p>
    You can also delete a link by clicking the <span class="icon-trash text-red"></span> icon. Note that it does not delete
    the target page, but only the link between two pages.
</p>
