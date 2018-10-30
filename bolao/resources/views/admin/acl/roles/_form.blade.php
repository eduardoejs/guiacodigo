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
                @php
                    $select = '';

                    // nao perde a selecao do select caso caia na validacao do campo do formulario
                    if(old('permissions') ?? false){
                        foreach(old('permissions') as $key => $id){
                            if($value->id == $id) {
                                $select = 'selected';
                            }
                        }
                    }else{
                        // logica para trazer as permissoes selecionadas que foram atribuidas no momento do create
                        if($register ?? false){
                            foreach($register->permissions as $key => $permission){
                                if($permission->id == $value->id) {
                                    $select = 'selected';
                                }
                            }
                        }
                    }
                @endphp

                <option {{ $select }} value="{{$value->id}}">Permite {{$value->description}}</option>
            @endforeach
        </select>
    </div>

</div>
