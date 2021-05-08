@extends('layouts.front')

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <h2>{{$category->name}}</h2>
            <hr>
        </div>
            @forelse($category->products as $key => $product)
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
