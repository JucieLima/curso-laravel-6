@extends('layouts.app')

@section('content')
    <h1>Criar Loja</h1>
    <form action="{{route('admin.stores.update', ['store' => $store->id])}}" method="post">

        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nome da Loja</label>
            <input type="text" name="name" value="{{$store->name}}" class="form-control">
        </div>

        <div class="form-group">
            <label for="description">Descrição</label>
            <input type="text" name="description" value="{{$store->description}}" class="form-control">
        </div>

        <div class="form-group">
            <label for="phone">Telefone/WhatsApp</label>
            <input type="text" name="phone" value="{{$store->phone}}" class="form-control">
        </div>

        <div class="form-group">
            <label for="mobile_phone">Celular</label>
            <input type="text" name="mobile_phone" value="{{$store->mobile_phone}}" class="form-control">
        </div>

        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" name="slug" value="{{$store->slug}}" class="form-control">
        </div>

        <div>
            <button class="btn btn-primary" type="submit">Atualizar Loja</button>
        </div>
    </form>
@endsection
