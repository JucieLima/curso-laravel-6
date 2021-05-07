@extends('layouts.front')

@section('content')
    <div class="row">
        <div class="col-12">
            <h2>Carrinho de compras</h2>
            <hr>
        </div>
        <div class="col-12">
            @if($cart)
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th style="max-height: 600px;">Produto</th>
                        <th>Preço</th>
                        <th>Quantidade</th>
                        <th>Subtotal</th>
                        <th>Ação</th>
                    </tr>
                    <tbdoy>
                        @php $total = 0; @endphp
                        @foreach($cart as $product)
                            <tr>
                                <td style="max-height: 600px;">{{$product['name']}}</td>
                                <td>R$ {{number_format($product['price'], 2, ',', '.')}}</td>
                                <td>{{$product['amount']}}</td>
                                @php
                                    $subtotal = $product['price']*$product['amount'];
                                    $total += $subtotal;
                                @endphp
                                <td>R$ {{number_format($subtotal, 2, ',', '.')}}</td>
                                <td><a href="{{route('cart.remove', ['slug' => $product['slug']])}}"
                                       class="btn btn-danger">excluir</a></td>
                            </tr>
                        @endforeach
                        <tr>
                            <th colspan="3">
                                Total:
                            </th>
                            <th colspan="2">
                                R$ {{$total}}
                            </th>
                        </tr>
                    </tbdoy>
                    </thead>
                </table>
                <div class="col-12">
                    <a href="{{route('cart.cancel')}}" class="btn btn-lg btn-danger pull-left">
                        Cancelar Compra
                    </a>
                    <a href="{{route('checkout.index')}}" class="btn btn-lg btn-success pull-right">
                        Concluir Compra
                    </a>
                </div>
            @else
                <div class="alert alert-warning">Carrinho vazio!</div>
            @endif
        </div>
    </div>
@endsection
