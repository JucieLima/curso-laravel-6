@extends('layout.app')

@section('content')
    <a href="{{route('admin.stores.create')}}" class="btn btn-lg btn-success mb-3 mt-3">Criar loja</a>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Loja</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        @foreach($stores as $store)
            <tr>
                <td>{{$store->id}}</td>
                <td>{{$store->name}}</td>
                <td>
                    <a href="{{route('admin.stores.edit', ['store' => $store->id])}}" class="btn btn-sm btn-primary">Editar</a>
                    <a href="{{route('admin.stores.destroy', ['store' => $store->id])}}" class="btn btn-sm btn-danger">Excluir</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$stores->links()}}
    <a href="{{route('admin.stores.create')}}" class="btn btn-lg btn-success mb-2 mt-3">Criar loja</a>
@endsection
