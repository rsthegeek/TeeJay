<div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">
    <label for="{{ $id or $name }}" class="col-md-4 control-label">{{ $title }}</label>

    <div class="col-md-6">
        <input id="{{ $id or $name }}" type="password" class="form-control"
               name="{{ $name }}"  dir="ltr" required>

        @if ($errors->has($name))
            <span class="help-block">
                <strong>{{ $errors->first($name) }}</strong>
            </span>
        @endif
    </div>
</div>