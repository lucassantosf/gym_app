<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Aladin System</title>    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> 
    <style type="text/css">
        body{ 
            background: url({{url('svg/academia.png')}}) no-repeat center top; 
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container border">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    Home
                </a>
                <div class="btn-group">
                    <button class="btn btn-lg " type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        Cadastros
                    </button>
                    <div class="dropdown-menu">
                        <a class="navbar-brand" href="{{ url('/cadastros/users') }}">
                            Usuários
                        </a>
                        <a class="navbar-brand" href="{{ url('/cadastros/plans') }}">
                            Planos
                        </a>
                        <a class="navbar-brand" href="{{ url('/cadastros/products') }}">
                            Produtos
                        </a>
                        <a class="navbar-brand" href="{{ url('/cadastros/modals') }}">
                            Modalidades
                        </a>
                        <a class="navbar-brand" href="{{ url('/cadastros/turmas') }}">
                            Turmas
                        </a>
                    </div>
                </div>

                <div class="btn-group ">
                    <button class="btn btn-lg" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Relatórios
                    </button>
                    <div class="dropdown-menu">
                        <a class="navbar-brand" href="{{ url('/home') }}">
                            Faturamento
                        </a><br>
                        <a class="navbar-brand" href="{{ url('/home') }}">
                            Planos
                        </a><br>
                        <a class="navbar-brand" href="{{ url('/home') }}">
                            Produtos
                        </a>
                        <a class="navbar-brand" href="{{ url('/home') }}">
                            Formas de Pagamento
                        </a>
                    </div>
                </div>             
                
                <a class="navbar-brand" href="{{ url('/clients') }}">
                    Clientes
                </a>
                <a class="navbar-brand" href="{{ url('/incluir/clients') }}">
                    Incluir Clientes
                </a>
                
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
    @hasSection('javascript')
        @yield('javascript')
    @endif

    
</body>
</html>
