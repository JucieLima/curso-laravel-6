<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Marketplace L6</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    @yield('stylesheets')
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-bottom: 40px;">

    <a class="navbar-brand" href="{{route('home')}}">Marketplace L6</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav mr-auto">
            <li class="nav-item @if(request()->is('/')) active @endif">
                <a class="nav-link" href="{{route('home')}}"><i class="fa fa-home" aria-hidden="true"></i> Home <span
                        class="sr-only">(current)</span></a>
            </li>

            @foreach($categories as $category)
                <li class="nav-item @if(request()->is('category/'.$category->slug)) active @endif">
                    <a class="nav-link"
                       href="{{route('category.single', ['slug' => $category->slug])}}">{{$category->name}}</a>
                </li>
            @endforeach
        </ul>

        <div class="my-2 my-lg-0">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a href="{{route('cart.index')}}" class="nav-link" alt="carrinho de compras">
                        <i class="fa fa-shopping-cart"></i>
                        Carrinho
                        @if(session()->has('cart'))
                            <span
                                class="badge badge-danger">{{array_sum(array_column(session()->get('cart'), 'amount'))}}</span>
                        @else
                            <span class="badge badge-danger">0</span>
                        @endif
                    </a>
                </li>
                @auth
                    <li class="nav-item">
                        <a href="{{route('user.orders')}}" title="Ver meus pedidos">
                            <span class="nav-link">{{auth()->user()->name}}
                                <i class="fa fa-user" aria-hidden="true"></i></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"
                           onclick="event.preventDefault();
                           document.querySelector('form.logout').submit(); ">Sair <i class="fa fa-sign-out"
                                                                                     aria-hidden="true"></i></a>

                        <form action="{{route('logout')}}" class="logout" method="POST" style="display:none;">
                            @csrf
                        </form>
                    </li>
                @endauth
            </ul>
        </div>


    </div>
</nav>

<div class="container">
    @include('flash::message')
    @yield('content')
</div>

<script
    src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
@yield('scripts')
</body>
</html>
