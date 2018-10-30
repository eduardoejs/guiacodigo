@if (!$search && $list)
    <div>
        {{$list->links()}}
        <small>Exibindo {{ $list->count() }} registros de {{ $list->total() }} [{{ $list->firstItem() }} a {{ $list->lastItem() }}]</small>
    </div>

@endif
