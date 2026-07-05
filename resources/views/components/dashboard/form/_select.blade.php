@php
    $replacedName = replaceNameWithDots($name);
    $title = __('label.'.($title ?? $replacedName));
    $labelId = empty($id) ? $name.'_'.rand() : $id;
@endphp
@if(!isset($noLabel))
<label for="{{$labelId}}" class="control-label">{{ $title }}</label>
@endif

<select name="{{ $name }}"
        id="{{$labelId}}"
        @isset($dataName)
            data-name="{{$dataName}}"
        @endisset
        @isset($dataSelected)
            data-selected="{{ $dataSelected }}"
        @endisset
        class="form-control {{ $class ?? '' }}"
        @isset($multiple) multiple @endisset
        @isset($allowClear) data-allow-clear="true" @endisset
        @isset($allowTags) data-allow-tags="true" @endisset
        @if(!empty($disabled)) disabled @endif
>
    @if(isset($defaultOption))
        <option value="">{{ __('__dashboard.select.option.default') }}</option>
    @endif
    @foreach($data as $key => $item)
        @php
            $optionKey   = is_array($item) ? ($item['id']    ?? $key)  : $key;
            $optionLabel = is_array($item) ? ($item['name']  ?? $item['title'] ?? '') : $item;
        @endphp
        <option value="{{ $optionKey }}"
            @isset($value)
                @if(is_array($value) && in_array($optionKey, $value))
                    selected
                @else
                    @if($optionKey == $value) selected @endif
                @endif
            @endisset
        >
            {{ $optionLabel }}
        </option>
    @endforeach
</select>
<x-dashboard.form._error :name="$replacedName" />

