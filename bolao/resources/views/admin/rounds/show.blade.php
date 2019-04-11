@extends('layouts.app')

@section('content')
    @page_component(['col' => 12, 'page' => __('bolao.show_crud', ['page' => $page_edit])])

        @alert_component(['msg' => session('msg'), 'status' => session('status')])
        @endalert_component

        @breadcrumb_component(['page' => $page, 'items' => $breadcrumb ?? []])
        @endbreadcrumb_component

        <p>@lang('bolao.round'): {{ $register->title }}</p>
        <p>@lang('bolao.betting_title'): {{ $register->betting->title }}</p>
        <p>@lang('bolao.date_start'): {{ $register->date_start_friendly }}</p>
        <p>@lang('bolao.date_end'): {{ $register->date_end_friendly }}</p>

        @if ($delete)
            @form_component(['action' => route($routeName.'.destroy', $register->id), 'method' => 'DELETE'])
                <button type="submit" class="btn btn-danger btn-lg">@lang('bolao.delete')</button>
            @endform_component

        @endif

    @endpage_component
@endsection
