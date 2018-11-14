@extends('layouts.app')

@section('content')
    @page_component(['col' => 12, 'page' => __('bolao.show_crud', ['page' => $page_edit])])

        @alert_component(['msg' => session('msg'), 'status' => session('status')])
        @endalert_component

        @breadcrumb_component(['page' => $page, 'items' => $breadcrumb ?? []])
        @endbreadcrumb_component

        <p>@lang('bolao.name'): {{ $register->name }}</p>
        <p>@lang('bolao.email-address'): {{ $register->email }}</p>

        <div>
            @if ($register->roles->count() > 1)
                <h5>Perfis vinculados ao usuário</h5>
            @else
                <h5>Perfil vinculado ao usuário</h5>
            @endif
            <ul class="list-group mb-2">
                @forelse ($register->roles as $role)
                    <li class="list-group-item list-group-item-info">{{ $role->description }}</li>
                @empty
                    <li class="list-group-item list-group-item-warning h5">Não existe perfil de acesso vinculado ao usuário selecionado.</li>
                @endforelse
            </ul>
        </div>

        @if ($delete)
            @form_component(['action' => route($routeName.'.destroy', $register->id), 'method' => 'DELETE'])
                <button type="submit" class="btn btn-danger btn-lg">@lang('bolao.delete')</button>
            @endform_component

        @endif

    @endpage_component
@endsection
