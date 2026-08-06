@php
    $replacedName = replaceNameWithDots($name);
    $labelKey = 'label.'.($title ?? $replacedName);
    $title = \Illuminate\Support\Facades\Lang::has($labelKey)
        ? __($labelKey)
        : \Illuminate\Support\Str::of($title ?? $replacedName)->replace(['_', '.'], ' ')->title();
    $labelId = empty($id) ? $name.'_'.rand() : $id;
    $type = $type ?? 'text'
@endphp

@if(!isset($noLabel))
<label for="{{ $labelId }}" class="control-label">{{ $title }}</label>
@endif

<input type="{{ $type }}"
       id="{{$labelId}}"
       @isset($autocomplete) autocomplete="off" @endisset
       @if(!empty($readonly)) readonly @endif
       @if(!empty($disabled)) disabled @endif
       @if(!isset($noPlaceholder))
       @if($type === 'number') min="0" @endif
       placeholder="{{ $title }}"
       @endif
       @if(isset($decimal))
       step="any"
       @endif
       name="{{ $name ?? '' }}"
       value="{{ $value ?? '' }}"
       class="form-control {{ $class ?? '' }}"
>
<x-dashboard.form._error :name="$replacedName" />
