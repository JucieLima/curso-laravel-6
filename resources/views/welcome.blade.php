@extends('layouts.front')

@section('content')
    <div class="row mb-4">
        @foreach($products as $key => $product)
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
        @endforeach
    </div>
@endsection
