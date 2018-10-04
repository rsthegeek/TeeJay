@php($requestParam = str_replace(['[', ']'], ['', ''], $name))
@php($defaultValue = Request::get($requestParam, isset($default) ? $default : null))
@php($isMulti = isset($multi) && $multi)
<div class="form-group {{$errors->has($name) ? 'has-error' : null }}
    {{ isset($wrapperClass) ? $wrapperClass : '' }}">
    @if(isset($title))
        <label for="{{ $id or $name }}"
               class="col-md-4 control-label">{{ $title }}</label>
    @endif
    <select name="{{ $name }}" class="form-control {{ (isset($class) ? $class : '')}}"
        {{ $isMulti ? 'multiple' : '' }}
        {{ isset($require) && $require ? 'required' : '' }}>
        {{--<option value="" {{ isset($value) ? : 'selected' }} disabled>{{ $placeHolder or '' }}</option>--}}
        @foreach($list as $index => $item)
            @if(
                (!$isMulti && $defaultValue == $index)
                || ($isMulti && in_array($index, (array) $defaultValue))
            )
                <option value="{{ $index }}" selected>{{ $item }}</option>
            @else
                <option value="{{ $index }}">{{ $item }}</option>
            @endif
        @endforeach
    </select>
    @if ($errors->has($name))
        <span class="help-block">
            <strong>{{ $errors->first($name) }}</strong>
        </span>
    @endif
</div>

@section('header')
@parent
<link href="{{ asset('css/plugins/select2/select2.min.css') }}" rel="stylesheet">

@if(isset($dir))
<style>
    .select2-container,
    .select2-results__options li,
    .select2-container--default .select2-search--dropdown .select2-search__field {
    direction: {{ $dir }} !important;
    }

    .select2-results__option {
    text-align: {{ $dir == 'ltr' ? 'left' : 'right' }} !important;
    }
    @if($dir == 'ltr')
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        right: 1px !important;
        left: auto !important;
    }
    @endif
</style>
@endif
@endsection

@section('footer')
@parent
<script src="{{ asset('js/plugins/select2/select2.full.min.js') }}"></script>
<script>
    $("select[name='{{ $name }}']").select2({
        placeholder: "{{ $placeHolder or ''}}",
    });
</script>
@endsection
