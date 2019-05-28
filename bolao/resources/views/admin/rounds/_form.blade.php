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
        <label for="betting_id">{{ __('bolao.betting') }}</label>
        <select name="betting_id" id="" class="form-control {{ $errors->has('betting_id') ? ' is-invalid' : '' }}">        
            @foreach ($listRel as $key => $value)
                @php
                    $select = '';

                    if(old('betting_id') ?? false) {                        
                        if(old('betting_id') == $value->id) {
                            $select = 'selected';
                        }                        
                    }else {
                        if($register_id ?? false) {
                            if($register_id == $value->id) {
                                $select = 'selected';
                            }
                        }
                    }                    
                @endphp
                <option {{$select}} value="{{$value->id}}">{{$value->title}}</option>
            @endforeach
        </select>
        @if ($errors->has('betting_id'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('betting_id') }}</strong>
            </span>
        @endif    
    </div>

    <div class="form-group col-6">
        <label for="date_start">{{ __('bolao.date_start') }} ({{ date('Y-m-d H:i') }})</label>
        <input type="datetime" name="date_start" value="{{ old('date_start') ?? ($register->date_start ?? '') }}" class="form-control {{ $errors->has('date_start') ? ' is-invalid' : '' }}" placeholder="{{ date('Y-m-d H:i') }}">
        @if ($errors->has('date_start'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('date_start') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group col-6">
        <label for="date_end">{{ __('bolao.date_end') }} ({{ date('Y-m-d H:i') }})</label>
        <input type="datetime" name="date_end" value="{{ old('date_end') ?? ($register->date_end ?? '') }}" class="form-control {{ $errors->has('date_end') ? ' is-invalid' : '' }}" placeholder="{{ date('Y-m-d H:i') }}">
        @if ($errors->has('date_end'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('date_end') }}</strong>
            </span>
        @endif
    </div>    
</div>
