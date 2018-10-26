@extends('layouts.app')

@section('content')
    @page_component(['col' => 12, 'page' => __('bolao.edit_crud', ['page' => $page_edit])])

        @alert_component(['msg' => session('msg'), 'status' => session('status')])
        @endalert_component

        @breadcrumb_component(['page' => $page, 'items' => $breadcrumb ?? []])
        @endbreadcrumb_component

        @form_component(['action' => route($routeName.'.update', $register->id), 'method' => 'PUT'])
            @include('admin.acl.'.$routeName.'._form')
            <button type="submit" class="btn btn-primary btn-lg float-right">@lang('bolao.edit')</button>
        @endform_component

    @endpage_component
@endsection
