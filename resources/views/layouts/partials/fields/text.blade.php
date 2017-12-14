<div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">
    <label for="{{ $name }}" class="col-md-4 control-label">{{ $title }}</label>

    <div class="col-md-6">
        <input id="{{ $id or $name }}" type="text" class="form-control"
               name="{{ $name }}" value="{{ old($name) }}"
               {{ isset($required) && $required ? 'required' : '' }}
               {{ isset($autofocus) && $autofocus ? 'autofocus' : '' }}>

        @if ($errors->has($name))
            <span class="help-block">
                <strong>{{ $errors->first($name) }}</strong>
            </span>
        @endif
    </div>
</div>