<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Marketpalce L6</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
    <a class="navbar-brand" href="{{route('home')}}">Marketpace L6</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado"
            aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
        @auth
        <ul class="navbar-nav mr-auto">
            <li class="nav-item @if(request()->is('admin/stores*')) active @endif">
                <a class="nav-link" href="{{route('admin.stores.index')}}">Loja <span
                        class="sr-only">(página atual)</span></a>
            <li class="nav-item @if(request()->is('admin/orders*')) active @endif">
                <a class="nav-link" href="{{route('admin.orders.my')}}">Meus Pedidos</a>
            </li>
            <li class="nav-item @if(request()->is('admin/products*')) active @endif">
                <a class="nav-link" href="{{route('admin.products.index')}}">Produtos</a>
            </li>
            <li class="nav-item @if(request()->is('admin/categories*')) active @endif">
                <a class="nav-link" href="{{route('admin.categories.index')}}">Categorias</a>
            </li>
        </ul>
        <div class="my-2 my-lg-0">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item @if(request()->is('/')) active @endif">
                    <a class="nav-link" href="{{route('home')}}"><i class="fa fa-home" aria-hidden="true"></i> Home <span
                            class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                       onclick="event.preventDefault(); document.querySelector('form.logout').submit();"
                       href="#">Sair</a>
                </li>
            </ul>
        </div>
        @endauth
    </div>
</nav>
<div class="container">
    <div class="content">
        @include('flash::message')
        @yield('content')
    </div>
</div>
<form action="{{route('logout')}}" class="logout" style="display: none" method="post">
    @csrf
</form>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>
