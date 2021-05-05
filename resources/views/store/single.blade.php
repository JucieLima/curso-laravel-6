@extends('layouts.front')

@section('content')
    <div class="row mb-4">
        <div class="col-6">
            @if($product->photos->count())
                <img src="{{asset('storage/'.$product->photos->first()->image)}}" alt="Imagem de: {{$product->name}}"
                     class="img-fluid">
                <!--Carousel Wrapper-->
                <div id="carouselExampleControls" class="carousel slide mt-2" data-ride="carousel">

                    <!--Slides-->
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                            <div class="row">
                                @foreach($product->photos as $key => $photo)


                                    <div class="col-4 col-md-3">
                                        <img src="{{asset('storage/'.$photo->image)}}"
                                             alt="Imagem de: {{$product->name}}" class="img-fluid">
                                    </div>

                                    @if(($key+1)% 4 == 0 && $key+1 != $product->photos->count())
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="row">
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!--/.Slides-->

                    <!--Controls-->
                    <div class="controls-top">
                        <a class="btn-floating" href="#carouselExampleControls" data-slide="prev"><i
                                class="fa fa-chevron-left"></i></a>
                        <a class="btn-floating" href="#carouselExampleControls" data-slide="next"><i
                                class="fa fa-chevron-right"></i></a>
                    </div>
                    <!--/.Controls-->
                    <!--/.Carousel Wrapper-->
                </div>
            @else
                <img src="{{asset('assets/img/no-photo.jpg')}}" alt="este produto não possui imagem"
                     class="card-img-top">
            @endif
        </div>
        <div class="col-6">
            <div>
                <h2>{{$product->name}}</h2>
                <p>{{$product->description}}</p>
                <h3>R$ {{number_format($product->price, 2, ',', '.')}}</h3>
                <span>Loja: {{$product->store->name}}</span>
            </div>
            <hr>
            <div class="add-product mt-3">
                <form action="{{route('cart.add')}}" method="post">
                    <input type="hidden" name="product[name]" value="{{$product->name}}">
                    <input type="hidden" name="product[price]" value="{{$product->price}}">
                    <input type="hidden" name="product[slug]" value="{{$product->slug}}">
                    <div class="form-group">
                        <label for="buy_product">Quantidade:</label>
                        <input type="number" name="product[amount]" class="form-control col-md-2" min="1" id="buy_product" value="1">
                    </div>
                    <button class="btn btn-primary">Comprar</button>
                    @csrf
                </form>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            {{$product->body}}
        </div>
    </div>
@endsection
