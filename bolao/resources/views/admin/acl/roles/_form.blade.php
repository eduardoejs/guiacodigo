<div class="row">
    <div class="form-group col-6">
        <label for="name">{{ __('bolao.name') }}</label>
        <input type="text" name="name" value="{{ old('name') ?? ($register->name ?? '') }}" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}">
        @if ($errors->has('name'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group col-6">
        <label for="description">{{ __('bolao.description') }}</label>
        <input type="description" name="description" value="{{ old('description') ?? ($register->description ?? '') }}" class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}">
        @if ($errors->has('description'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('description') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group col-6">
        <label for="permissions">{{ __('bolao.permission_list') }}</label>
        <select multiple name="permissions[]" id="" class="form-control">
            @foreach ($permissions as $key => $value)
                <option value="{{$value->id}}">Permite {{$value->description}}</option>
            @endforeach
        </select>
    </div>

</div>
