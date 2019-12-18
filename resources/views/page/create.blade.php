@extends('base')

@section('title', $title)

@section('content')
    <span class="pull-right toggle-help close glyphicon glyphicon-question-sign"></span>
    <h2>{{ trans('page.edit_pages_title') }}</h2>

    {{-- Parent page(s) --}}
    @if (!$page->is_first)
        <div class="row">
            <div class="col col-border-left col-border-right col-parents">
                @info({!! trans('page.parent_pages_help') !!})

                <div>
                    <div class="tab-content">
                        @if($page->parents())
                            @foreach($page->parents() as $key => $parent)
                                <div class="tab-pane active" id="pp{{ $key }}">
                                    @include('page.partials.create_readonly', ['page' => $parent])
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <nav class="nav nav-pills" id="choicesList">
                        @if($page->parents())
                            @foreach($page->parents() as $key => $choice)
                                <a class="nav-item nav-link @if ($key === 0) active @endif" href="#pp{{ $key }}" data-toggle="tab">
                                <span class="choice_title_{{ $key }}">
                                    <input type="text" class="form-control" placeholder="{{ trans('page.link_text') }}" value="{{ $choice->link_text }}">
                                </span>
                                </a>
                            @endforeach
                        @endif
                    </nav>
                </div>
            </div>
        </div>
    @endif

    <hr>

    {{-- Current page --}}
    {!! Form::hidden('page_from', $page->id, ['id' => 'page_from']) !!}
    <div class="row" id="current_page">
        <div class="col-lg-8 col-xs-12 col-border-left col-current">
            @info({!! trans('page.current_page_help') !!})

            @include('page.partials.create', ['readonly' => false])
        </div>
        <div class="col-lg-4 col-xs-12 col-border-right col-current">
            <div class="row">
                <div class="col">
                    @info({!! trans('page.current_page_prerequisites_help') !!})

                    <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modalCreatePrerequisite">
                        <span class="glyphicon glyphicon-plus-sign"></span>
                        {{ trans('actions.add_new_prerequisite') }}
                    </button>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col">
                    @info({!! trans('page.current_page_actions_help') !!})

                    <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modalCreateAction">
                        <span class="glyphicon glyphicon-plus-sign"></span>
                        {{ trans('actions.add_new_action') }}
                    </button>

                    @include('page.partials.actions_list', ['page' => $page])
                </div>
            </div>
        </div>
    </div>

    <hr>

    {{-- Choice(s) --}}
    <div class="row">
        <div class="col col-border-left col-border-right col-choices">
            @info({!! trans('page.current_page_choices_help') !!})

            <nav class="nav nav-pills" id="choicesList">
                @if($page->choices())
                    @foreach($page->choices() as $key => $choice)
                        <a class="nav-item nav-link @if ($key === 0) active @endif" href="#p{{ $key }}" data-toggle="tab">
                            <span class="choice_title_{{ $key }}">
                                <input type="text" class="form-control" placeholder="{{ trans('page.link_text') }}" id="linktext-{{ $key + 1 }}" value="{{ $choice->link_text }}">
                            </span>
                        </a>
                    @endforeach
                @endif
                <a class="nav-item nav-link" href="" id="addNewPage">+</a>
                <a class="nav-item nav-link" href="">
                    <select class="form-control mr-sm-2" id="childrenSelect">
                        <option value="0" selected>{{ trans('page.existing_page') }}</option>
                        @foreach ($page->getPotentialChildren() as $existingPage)
                            @if ($existingPage->id !== $page->id)
                                <option value="{{ $existingPage->id }}">{{ $existingPage->title }}</option>
                            @endif
                        @endforeach
                    </select>
                </a>
            </nav>
            <div class="tab-content" id="choicesForm">
                @if($page->choices())
                    @foreach($page->choices() as $key => $choice)
                        <div class="tab-pane @if ($key === 0) active @endif" id="p{{ $key }}">
                            @include('page.partials.create', ['page' => $choice, 'internalId' => $key + 1, 'readonly' => false])
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <!-- Modal new Action -->
    <div class="modal" id="modalCreateAction" tabindex="-1" role="dialog" aria-labelledby="modalCreateActionTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCreateActionTitle">{{ trans('page.actions_modal_title') }}</h5>
                    <span class="close toggle-help glyphicon glyphicon-question-sign">
                    </span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('page.partials.modal_actions', ['page' => $page])
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="add_action"
                        data-original-text="{{ trans('actions.add_action') }}">{{ trans('actions.add_action') }}</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal new Prerequisite -->
    <div class="modal" id="modalCreatePrerequisite" tabindex="-1" role="dialog" aria-labelledby="modalCreatePrerequisiteTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCreatePrerequisiteTitle">{{ trans('page.prerequisite_modal_title') }}</h5>
                    <span class="close toggle-help glyphicon glyphicon-question-sign">
                    </span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('page.partials.modal_prerequisites', ['page' => $page])
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="add_prerequisite">{{ trans('actions.add_action') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('footer-scripts')
    @include('page.js.create-js')
@endpush
