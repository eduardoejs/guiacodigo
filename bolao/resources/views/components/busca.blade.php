<form class="form-inline" method="GET" action="{{ route($routeName.'.index') }}">
    <div class="form-group mb-2">
        @can('add-user')
            <a href="{{ route($routeName.'.create') }}">@lang('bolao.add')</a>
        @endcan
    </div>
    <div class="form-group mx-sm-3 mb-2">
        <input type="search" class="form-control" placeholder="@lang('bolao.search-message')" name="search" value="{{ $search }}">
    </div>
    <button type="submit" class="btn btn-primary mb-2">@lang('bolao.search')</button>
    <a href="{{ route($routeName.'.index') }}" class="btn btn-secondary mb-2 ml-1">@lang('bolao.clean')</a>
</form>
