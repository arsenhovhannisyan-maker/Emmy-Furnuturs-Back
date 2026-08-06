@php
    $replacedName = replaceNameWithDots($name);
    $labelKey = 'label.'.($title ?? $replacedName);
    $title = \Illuminate\Support\Facades\Lang::has($labelKey)
        ? __($labelKey)
        : \Illuminate\Support\Str::of($title ?? $replacedName)->replace(['_', '.'], ' ')->title();
    $labelId = empty($id) ? $name.'_'.rand() : $id;
@endphp

<div class="custom-checkbox mb-2">
    <input type="checkbox"
           id="{{$labelId}}"
           @isset($dataName)
               data-name="{{$dataName}}"
           @endisset
           @if(!empty($readonly)) readonly @endif
           @if(!empty($disabled)) disabled @endif
           @if(isset($checked) && $checked) checked @endif
           name="{{ $name ?? '' }}"
           value="{{ $value ?? '1' }}"
           class="form-check-input {{ $class ?? '' }}">
    <label for="{{ $labelId }}" class="control-label checkbox-label">{{ $title }}</label>
</div>
<x-dashboard.form._error :name="$replacedName" />

