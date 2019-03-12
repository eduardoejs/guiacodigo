<div class="row">

    <div class="form-group col-6">
        <label for="title">{{ __('bolao.title') }}</label>
        <input type="text" name="title" value="{{ old('title') ?? ($register->title ?? '') }}" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}">
        @if ($errors->has('title'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('title') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group col-6">
        <label for="value_result">{{ __('bolao.value_result') }}</label>
        <input type="value_result" name="value_result" value="{{ old('value_result') ?? ($register->value_result ?? '') }}" class="form-control {{ $errors->has('value_result') ? ' is-invalid' : '' }}">
        @if ($errors->has('value_result'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('value_result') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group col-6">
        <label for="extra_value">{{ __('bolao.extra_value') }}</label>
        <input type="extra_value" name="extra_value" value="{{ old('extra_value') ?? ($register->extra_value ?? '') }}" class="form-control {{ $errors->has('extra_value') ? ' is-invalid' : '' }}">
        @if ($errors->has('extra_value'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('extra_value') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group col-6">
        <label for="value_free">{{ __('bolao.value_free') }}</label>
        <input type="value_free" name="value_free" value="{{ old('value_free') ?? ($register->value_free ?? '') }}" class="form-control {{ $errors->has('value_free') ? ' is-invalid' : '' }}">
        @if ($errors->has('value_free'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('value_free') }}</strong>
            </span>
        @endif
    </div>
</div>
