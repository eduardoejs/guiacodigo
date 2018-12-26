@extends('layouts.app')

@section('content')
    @page_component(['col' => 12, 'page' => $page])

        @alert_component(['msg' => session('msg'), 'status' => session('status')])
        @endalert_component

        <div class="row">
                @can('list-user')
                    <div onclick="window.location='{{ route('users.index') }}'" style="cursor:pointer" class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                        <div class="card-header">@lang('bolao.list', ['page' => __('bolao.user_list')])</div>
                        <div class="card-body">
                          <p class="card-text">@lang('bolao.create_or_edit')</p>
                        </div>
                    </div>
                @endcan
            </div>

            <div class="row">
                <div class="card">
                    <div class="card-header">
                        @lang('bolao.acl')
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div onclick="window.location='{{ route('roles.index') }}'" style="cursor:pointer" class="card text-white bg-secondary mb-3 mr-1" style="max-width: 18rem;">
                                <div class="card-header">@lang('bolao.list', ['page' => __('bolao.role_list')])</div>
                                <div class="card-body">
                                    <p class="card-text">@lang('bolao.create_or_edit')</p>
                                </div>
                            </div>
                            <div onclick="window.location='{{ route('permissions.index') }}'" style="cursor:pointer" class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                                <div class="card-header">@lang('bolao.list', ['page' => __('bolao.permission_list')])</div>
                                <div class="card-body">
                                    <p class="card-text">@lang('bolao.create_or_edit')</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

    @endpage_component

@endsection
