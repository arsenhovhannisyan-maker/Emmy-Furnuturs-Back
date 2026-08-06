@php
    $replacedName = replaceNameWithDots($name);
    $labelKey = 'label.'.($title ?? $replacedName);
    $title = \Illuminate\Support\Facades\Lang::has($labelKey)
        ? __($labelKey)
        : \Illuminate\Support\Str::of($title ?? $replacedName)->replace(['_', '.'], ' ')->title();
    $labelId = empty($id) ? $name.'_'.rand() : $id;
@endphp

<div class="custom-radio-block mb-2">
    <input type="radio"
           id="{{$labelId}}"
           @if(!empty($readonly)) readonly @endif
           @if(!empty($disabled)) disabled @endif
           @if(isset($checked) && $checked) checked @endif
           name="{{ $name ?? '' }}"
           value="{{ $value ?? '' }}"
           class="custom-radio {{ $class ?? '' }}"
    >
    <label for="{{ $labelId }}" class="form-check-label">{{ $title }}</label>
</div>
<x-dashboard.form._error :name="$replacedName" />

