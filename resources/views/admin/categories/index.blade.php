@extends('layouts.app')


@section('content')

    <a href="{{route('admin.categories.create')}}" class="btn btn-success mb-2">Criar Categoria</a>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Nome</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{$category->id}}</td>
                <td>{{$category->name}}</td>
                <td width="15%">
                    <div class="btn-group">
                        <a href="{{route('admin.categories.edit', ['category' => $category->slug])}}" class="btn btn-sm btn-primary rounded mr-1">Editar</a>
                        <form action="{{route('admin.categories.destroy', ['category' => $category->slug])}}" method="post">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
