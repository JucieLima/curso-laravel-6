@extends('layouts.front')

@section('content')
    <div class="row mb-4">
        <div class="col-md-3">
            @if($store->logo)
                <img src="{{asset('storage/'.$store->logo)}}" alt="logo" class="img-fluid">
            @else
                <img src="{{asset('assets/img/no-image.jpg')}}" alt="esta loja não possui logo"
                     class="img-fluid">
            @endif
        </div>
        <div class="col-md-9 text-md-right  pt-4">
            <h2>{{$store->name}}</h2>
            <p>{{$store->decription}}</p>
            <p>
                <strong>Contatos:</strong>
                <span><i class="fa fa-phone"></i> {{$store->phone}}</span> | <span><i class="fa fa-whatsapp"></i> {{$store->mobile_phone}}</span>
            </p>
        </div>
        <div class="col-12">
            <hr>
            <h4 class="mb-4 mt-4">
                Produtos da loja:
            </h4>
        </div>
        @forelse($store->products as $key => $product)
            <div class="col-md-4 mb-2">
                <div class="card">
                    @if($product->photos->count())
                        <a href="{{route('product.single', [$product->slug])}}" title="Comprar produto">
                            <img src="{{asset('storage/'.$product->photos->first()->image)}}"
                                 alt="Imagem de: {{$product->name}}" class="card-img-top">
                        </a>
                    @else
                        <img src="{{asset('assets/img/no-photo.jpg')}}" alt="este produto não possui imagem"
                             class="card-img-top">
                    @endif
                    <div class="card-body">
                        <a href="{{route('product.single', [$product->slug])}}" title="Comprar produto">
                            <h2 class="card-title">{{$product->name}}</h2>
                        </a>
                        <p class="card-text">{{$product->description}}</p>
                        <h3>R$ {{number_format($product->price, 2, ',', '.')}}</h3>
                        <a href="{{route('product.single', [$product->slug])}}" title="Comprar produto"
                           class="btn btn-success">
                            Ver Produto
                        </a>
                    </div>
                </div>
            </div>
            @if(($key+1)% 3 == 0)
    </div>
    <div class="row  mb-4">
        @endif
        @empty
            <div class="col-12">
                <div class="alert alert-info">
                    Ainda não temos produtos para mostrar aqui, por favor, volte mais tarde!
                </div>
            </div>
        @endforelse
    </div>
@endsection
