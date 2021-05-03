@extends('layouts.app')

@section('content')
    <h1>Atualizar Produto teste</h1>
    <form action="{{route('admin.products.update', ['product' => $product->id])}}" method="post">

        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="_token" value="{{csrf_token()}}">

        <div class="form-group">
            <label for="name">Nome da Loja</label>
            <input type="text" name="name" class="form-control" value="{{$product->name}}">
        </div>

        <div class="form-group">
            <label for="description">Descrição</label>
            <input type="text" name="description" class="form-control" value="{{$product->description}}">
        </div>

        <div class="form-group">
            <label for="body">Conteúdo</label>
            <textarea name="body" rows="10" class="form-control">{{$product->body}}</textarea>
        </div>

        <div class="form-group">
            <label for="price">Preço</label>
            <input type="text" name="price" class="form-control" value="{{$product->price}}">
        </div>

        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" name="slug" class="form-control" value="{{$product->slug}}">
        </div>

        <div>
            <button class="btn btn-primary" type="submit">Atualizar Produto</button>
        </div>
    </form>
@endsection
