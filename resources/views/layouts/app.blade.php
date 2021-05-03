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
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{route('home')}}">Marketpace L6</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado"
            aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item @if(request()->is('admin/stores')) active @endif">
                <a class="nav-link" href="{{route('admin.stores.index')}}">Lojas <span
                        class="sr-only">(página atual)</span></a>
            </li>
            <li class="nav-item @if(request()->is('admin/products')) active @endif">
                <a class="nav-link" href="{{route('admin.products.index')}}">Produtos</a>
            </li>
        </ul>
        <div class="my-2 my-lg-0">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <span class="nav-link">
                        {{auth()->user()->name}}
                    </span>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                       onclick="event.preventDefault(); document.querySelector('form.logout').submit();"
                       href="#">Sair</a>
                </li>
            </ul>
        </div>
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
</html>
