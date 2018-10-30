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
        <label for="email">{{ __('bolao.email-address') }}</label>
        <input type="email" name="email" value="{{ old('email') ?? ($register->email ?? '') }}" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}">
        @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group col-6">
        <label for="password">{{ __('bolao.password') }}</label>
        <input type="password" name="password" value="" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}">
        @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group col-6">
        <label for="password">{{ __('bolao.confirm-password') }}</label>
        <input type="password" name="password_confirmation" value="" class="form-control">
    </div>

    <div class="form-group col-6">
        <label for="roles">{{ __('bolao.role_list') }}</label>
        <select multiple name="roles[]" id="" class="form-control">
            @foreach ($roles as $key => $value)
                @php
                    $select = '';

                    // nao perde a selecao do select caso caia na validacao do campo do formulario
                    if(old('roles') ?? false){
                        foreach(old('roles') as $key => $id){
                            if($value->id == $id) {
                                $select = 'selected';
                            }
                        }
                    }else{
                        // logica para trazer as permissoes selecionadas que foram atribuidas no momento do create
                        if($register ?? false){
                            foreach($register->roles as $key => $role){
                                if($role->id == $value->id) {
                                    $select = 'selected';
                                }
                            }
                        }
                    }
                @endphp

                <option {{ $select }} value="{{$value->id}}">{{$value->description}}</option>
            @endforeach
        </select>
    </div>
</div>
