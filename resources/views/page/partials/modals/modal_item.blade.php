<fieldset class="w-75">
    <legend>{{ $item->name }}</legend>

    <table class="table w-100 table-striped">
        <tbody>
            <tr>
                <th scope="row" class="w-50">@lang('item.price')</th>
                <td>{!! $item->present()->price !!}</td>
            </tr>
            <tr>
                <th scope="row">@lang('item.is_unique')</th>
                <td>
                    <label>
                        {!! Form::checkbox('is_unique', 1, $item->is_unique,  ['id' => 'is_unique', 'disabled' => true]) !!}
                    </label>
                </td>
            </tr>
            <tr>
                <th scope="row">@lang('item.size')</th>
                <td>{{ $item->size }}</td>
            </tr>
            @if ($item->effects->count() > 0)
                <tr>
                    <th scope="row">{{ trans('item.effects') }}</th>
                    <td class="p-0">
                        @foreach ($item->effects as $effect)
                            <div class="row">
                                <div class="col p-2">
                                    @include('story.partials.effects', [
                                        'name' => $effect->field->name,
                                        'value' => $effect->quantity,
                                        'operator' => $effect->operator === '+' ? 'add' : 'sub'
                                    ])
                                </div>
                            </div>
                        @endforeach
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
</fieldset>
