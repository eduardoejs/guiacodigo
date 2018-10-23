<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-{{ $col }}">
            <div class="card">
                <div class="card-header">@lang('bolao.list', ['page' => $page])</div>

                <div class="card-body">

                    {{ $slot }}

                </div>
            </div>
        </div>
    </div>
</div>
