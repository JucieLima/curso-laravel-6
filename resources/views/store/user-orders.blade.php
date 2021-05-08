@extends('layouts.front')

@section('content')
    <div class="row">
        <div class="col-12">
            <h2>Meus Pedidos</h2>
            <hr>
        </div>
        <div class="col-12">
            <div class="accordion mb-3" id="accordionExample">
                @forelse($userOrders as $key => $userOrder)
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse"
                                        data-target="#collapse{{$key}}" aria-expanded="true"
                                        aria-controls="collapseOne">
                                    Pedido nº: {{$userOrder->reference}}
                                </button>
                            </h5>
                        </div>

                        <div id="collapse{{$key}}" class="collapse @if($key == 0) show @endif"
                             aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                                @php
                                    $items = unserialize($userOrder->items);
                                @endphp
                                @if($items)
                                    @foreach($items as $item)
                                        <li>R$ {{number_format($item['price'],2, ',', '.')}} - {{$item['name']}}</li>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-warning">
                        Nenhum pedido recebido até o momento!
                    </div>
                @endforelse
            </div>
            {{$userOrders->links()}}
        </div>
    </div>
@endsection
