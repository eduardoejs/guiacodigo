@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">@lang('bolao.dashboard')</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <div onclick="window.location='{{ route('users.index') }}'" style="cursor:pointer" class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                            <div class="card-header">@lang('bolao.list', ['page' => __('bolao.user_list')])</div>
                            <div class="card-body">
                              <p class="card-text">@lang('bolao.create_or_edit')</p>
                            </div>
                        </div>
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

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
