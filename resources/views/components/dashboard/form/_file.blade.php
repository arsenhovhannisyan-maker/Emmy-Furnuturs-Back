@php
    $replacedName = replaceNameWithDots($name);
    $labelKey = 'label.'.($title ?? $replacedName);
    $title = \Illuminate\Support\Facades\Lang::has($labelKey)
        ? __($labelKey)
        : \Illuminate\Support\Str::of($title ?? $replacedName)->replace(['_', '.'], ' ')->title();
    $labelId = empty($id) ? $name.'_'.rand() : $id;
@endphp

@if(!isset($noLabel))
    <label for="{{ $labelId }}" class="control-label">{{ $title }}</label>
@endif

<input type="file"
       id="{{$labelId}}"
       @if(!empty($readonly)) readonly @endif
       @if(!empty($disabled)) disabled @endif
       @isset($multiple) multiple @endisset
       name="{{ $name ?? '' }}"
       class="form-control {{ $class ?? '' }}">
<x-dashboard.form._error :name="$replacedName" />
