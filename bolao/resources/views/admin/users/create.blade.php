@extends('layouts.app')

@section('content')
    @page_component(['col' => 12, 'page' => __('bolao.create_crud', ['page' => $page_create])])

        @alert_component(['msg' => session('msg'), 'status' => session('status')])
        @endalert_component

        @breadcrumb_component(['page' => $page, 'items' => $breadcrumb ?? []])
        @endbreadcrumb_component

        @form_component(['action' => route($routeName.'.store'), 'method' => 'POST'])
            @include('admin.users._form')
            <button type="submit" class="btn btn-primary btn-lg float-right">Adicionar</button>
        @endform_component

    @endpage_component
@endsection
