<div class="modal" id="modalImage" tabindex="-1" role="dialog" aria-labelledby="modalImageTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="splide w-100 shadow" id="modal-splide">
                    <div class="splide__track">
                        <ul class="splide__list">
                            <li class="splide__slide">
                                <div class="splide__slide__container">
                                    <img src="{{ asset('img/screenshots/creation_interface.webp') }}" class="w-100">
                                </div>
                                <div class="text-center pb-4">@lang('home.page_creation_interface_text')</div>
                            </li>
                            <li class="splide__slide">
                                <div class="splide__slide__container">
                                    <img src="{{ asset('img/screenshots/character_creation.webp') }}" class="w-100">
                                </div>
                                <div class="text-center pb-4">@lang('home.character_creation_interface_text')</div>
                            </li>
                            <li class="splide__slide">
                                <div class="splide__slide__container">
                                    <img src="{{ asset('img/screenshots/story_creation.webp') }}" class="w-100">
                                </div>
                                <div class="text-center pb-4">@lang('home.story_creation_interface_text')</div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('common.close')</button>
            </div>
        </div>
    </div>
</div>
