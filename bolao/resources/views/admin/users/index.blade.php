@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                          <li class="breadcrumb-item active" aria-current="page">Lista de Usuários</li>
                        </ol>
                    </nav>

                    @if (count($list) > 0)
                        <form class="form-inline" method="GET" action="{{ route('users.index') }}">
                            <div class="form-group mb-2">
                            <a href="#">Adicionar</a>
                            </div>
                            <div class="form-group mx-sm-3 mb-2">
                                <input type="search" class="form-control" placeholder="Buscar registro" name="search" value="{{ $search }}">
                            </div>
                            <button type="submit" class="btn btn-primary mb-2">Buscar</button>
                            <a href="{{ route('users.index') }}" class="btn btn-secondary mb-2 ml-1">Limpar</a>
                        </form>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list as $key => $value)
                                        <tr>
                                            <td scope='row'>{{ $value->id }}</td>
                                            <td>{{ $value->name }}</td>
                                            <td>{{ $value->email }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
                @if (!$search && $list)
                    <div class="card-footer">
                        {{$list->links()}}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
