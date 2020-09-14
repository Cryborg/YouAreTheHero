<h3>Insert variables</h3>

<div class="ml-4 justify-content-end">
    <p>
        You can insert some variables, like the name of the character created by the player. When editing the page content,
        click on the @editorbutton({{ trans('page.variables_label') }}) button and select @lang('character.name_label').
    </p>
    <p>
        <img src="{{ asset('img/screenshots/editor_variables.png') }}" class="shadow img-fluid mb-4">
    </p>
    <p>
        It will insert "[[character_name]]" in your text during the edit. So:
    </p>
    <div class="example text-monospace">
        Hello [[character_name]]!
    </div>
    <div>
        Will be translated to:
    </div>
    <div class="example">
        Hello {{ Auth::user()->username }}!
    </div>
</div>

<h3 class="mt-4">Insert a command</h3>

<div class="ml-5 justify-content-end">
    <h4><i>stutter[&lt;word(s)&gt;]</i></h4>

    <div class="ml-4 justify-content-end">
        <div class="example text-monospace">
            # Editeur<br>
            Good morning stutter[Sir], stutter[how] do you do?<br>
            <br>
            # Résultat<br>
            Good morning S...Sir, h...h...how do you do?
        </div>
    </div>

    <h4><i>genre[&lt;masculine&gt;|&lt;féminine&gt;]</i></h4>

    <div class="ml-4 justify-content-end">
        <p>
            When you create a story, you can choose the genre of the main character. The player will then have to choose a
            character name that suits his/her genre.
        </p>
        <p>
            But you can let the player choose the genre. This can be interesting, but you will face moments where you will
            have to adapt your text to this. Let's see with a very basic example.
        </p>
        <div class="example text-monospace">
            # Editeur<br>
            Your genre[pants are|skirt is] quite dirty! You should genre[bring them to the laundry|ask your husband to clean it].
        </div>
        <p>
            If the character is male, here is what will be printed:
        </p>
        <div class="example text-monospace">
            Your pants are quite dirty! You should bring them to the laundry.
        </div>
        <p>
            But if she is female:
        </p>
        <div class="example text-monospace">
            Your skirt is quite dirty! You should ask your husband to clean it.
        </div>
    </div>
</div>

<h3 class="mt-5">Insert descriptions</h3>

<div class="ml-4 justify-content-end">
    <p>
        Sometimes you may need to insert inline descriptions to locations, items, anything, without polluting your main text.
        The @editorbutton({{ trans('description.description') }}) button on the editor displays a popup that allows you to
        do this.
    </p>
    <div class="example">
        <p>
            You are walking down <a tabindex="0" role="button" data-trigger="hover" data-placement="top" data-toggle="popover" title="" data-content="<p>Dark and narrow, only lit by thin sunrays coming from the holes in the walls.</p>" data-original-title="a corridor"><span class="icon-eye text-lightgrey mr-1"></span>a corridor</a>.
            The red carpet muffles thesound of your footsteps.
        </p>
        <p>
            <a tabindex="0" role="button" data-trigger="hover" data-placement="top" data-toggle="popover" title="" data-content="<p>Some of the people on these portraits look like they were in Slytherin.</p>" data-original-title="Dusty portraits"><span class="icon-eye text-lightgrey mr-1"></span>Dusty portraits</a> are hanging on the walls on either side.
        </p>
    </div>
    <p>
        Notice the <span class="icon-eye text-lightgrey mr-1"></span> icon. Hover with your mouse, or tap with your finger
        on mobile devices, to open a little inline description.
    </p>
    <p>
        To create this kind of description, write your text as you would normally do. Then click on the @editorbutton({{ trans('description.description') }}) buton on the editor.
    </p>
    <p class=" m-4">
        <img src="{{ asset('img/screenshots/editor_descriptions.png') }}" class="shadow img-fluid mb-4">
    </p>
    <p>
        In the <span class="false-input d-inline">@lang('description.keyword')</span> field, enter the phrase you want to describe ("a corridor" in our example),
        and write down the description in the light editor under it.
    </p>
    <p class=" m-4">
        <img src="{{ asset('img/screenshots/descriptions.png') }}" class="shadow img-fluid">
    </p>
</div>
