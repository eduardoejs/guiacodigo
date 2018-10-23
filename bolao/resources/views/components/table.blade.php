<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                @foreach ($columnList as $key => $value)
                    <th scope="col">{{ $value }}</th>
                @endforeach
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
                </tr>
                @empty
                <tr>
                    <td colspan={{count($columnList)}}><div class="alert alert-info text-center" role="alert"> Sem registros! </div></td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
