@extends('layouts.app')

@section('content')
    <h1>Criar Produto</h1>
    <form action="{{route('admin.products.store')}}" method="post">

        <input type="hidden" name="_token" value="{{csrf_token()}}">

        <div class="form-group">
            <label for="name">Nome do produto</label>
            <input type="text" name="name" class="form-control">
        </div>

        <div class="form-group">
            <label for="description">Descrição</label>
            <input type="text" name="description" class="form-control">
        </div>

        <div class="form-group">
            <label for="body">Conteúdo</label>
            <textarea name="body" rows="10" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label for="price">Preço</label>
            <input type="text" name="price" class="form-control">
        </div>

        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" name="slug" class="form-control">
        </div>

        <div class="form-group">
            <label for="user">Lojas</label>
            <select name="store" id="store" class="form-control">
                @foreach($stores as $store)
                    <option value="{{$store->id}}">{{$store->name}}</option>
                @endforeach
            </select>
        </div>

        <div>
            <button class="btn btn-primary" type="submit">Criar Produto</button>
        </div>
    </form>
@endsection