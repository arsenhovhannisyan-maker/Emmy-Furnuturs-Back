@php
    $replacedName = replaceNameWithDots($name);
    $labelKey = 'label.'.($title ?? $replacedName);
    $title = \Illuminate\Support\Facades\Lang::has($labelKey)
        ? __($labelKey)
        : \Illuminate\Support\Str::of($title ?? $replacedName)->replace(['_', '.'], ' ')->title();
    $labelId = empty($id) ? $name.'_'.rand() : $id;
@endphp
@if(!isset($noLabel))
<label for="{{$labelId}}" class="control-label">{{ $title }}</label>
@endif

<textarea
       id="{{$labelId}}"
       @isset($dataName)
           data-name="{{$dataName}}"
       @endisset
       @isset($autocomplete) autocomplete="off" @endisset
       @if(!empty($readonly)) readonly @endif
       @if(!empty($disabled)) disabled @endif
       placeholder="{{ $title }}"
       name="{{ $name ?? '' }}"
       class="form-control {{ $class ?? '' }}"
       cols="{{ $cols ?? 30 }}" rows="{{ $rows ?? 10 }}"
>{{ $value ?? '' }}</textarea>
<x-dashboard.form._error :name="$replacedName" />
