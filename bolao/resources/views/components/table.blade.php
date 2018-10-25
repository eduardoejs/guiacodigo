<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                @foreach ($columnList as $key => $value)
                    <th scope="col">{{ $value }}</th>
                @endforeach
                <th scope="col">@lang('bolao.action')</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($list as $key => $value)
                <tr>
                    @foreach ($columnList as $columnName => $columnValue)
                        @if ($columnName == 'id')
                            <th scope='row'>@php echo $value->{$columnName} @endphp</th>
                        @else
                            <td>@php echo $value->{$columnName} @endphp</td>
                        @endif
                    @endforeach
                    <td>
                        <a href="{{ route($routeName.'.show', $value->id) }}"><i style="color:blue" class="material-icons">aspect_ratio</i></a>
                        <a href="{{ route($routeName.'.edit', $value->id) }}"><i style="color:gray" class="material-icons">edit</i></a>
                        <a href="{{ route($routeName.'.show', [$value->id, 'delete=1']) }}"><i style="color:red" class="material-icons">delete</i></a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan={{count($columnList)}}><div class="alert alert-info text-center" role="alert"> Sem registros! </div></td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
