<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Aladin System</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <meta name="csrf-token" content="{{ csrf_token() }}"> 
    <link rel="shortcut icon" href="{{url('icon/favicon.png')}}" type="imagem/png"/> 
    <link href="https://fonts.googleapis.com/css?family=Katibeh" rel="stylesheet">
    
    <link href="{{asset('css/app.css')}}" rel="stylesheet"> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <style type="text/css">
        html {
            height: 100%;
            overflow-x: hidden; 
        }
        body {  
            width: 100%;
            height: 100%; 
            background-image: linear-gradient(to bottom, #B0E0E6, white);  
            background-repeat: no-repeat; 
            min-height: 100%;
            display: grid;
            grid-template-rows: 1fr auto;
        }  
        @media screen and (min-width:768px){
            #imgApp {
                display:none;
            }  
        }
        @media screen and (max-width:768px){
            #imgLinkHome,#textM,#imgM,.textM{
                display:none;
            } 
        }  
        .footer {
            grid-row-start: 2;
            grid-row-end: 3;
        }
    </style>
</head>
<body>  
    <div class="content">
        <div class="row">
            <div class="col-sm-8" id="imgM">
                <img src="{{url('icon/aladin.png')}}" width="160" height="70" style="margin-left: 70px;opacity : 0.7"> 
            </div>
            <div class="col-sm-4" id="textM">
                <label style="margin-top: 20px; font-family: 'Katibeh', cursive; font-size: 23px;opacity : 0.7">The most fitness software in the World</label> 
            </div>
        </div>    
        <div class="navbar navbar-inverse navbar-expand-lg navbar-light" style="background-color: #87CEFA;" data-spy="affix" data-offset-top="197"> 
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#itens">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="itens" style="padding-left: 20px">
                <div class="btn-group">
                    <a class="navbar-brand" href="{{url('/home')}}" id="imgLinkHome">
                        <img src="{{url('icon/logo.png')}}" width="40" height="40"> 
                    </a>
                </div> 
                <div class="btn-group">
                    <button class="btn btn-lg" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
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
                <div class="btn-group">
                    <button class="btn btn-lg " type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        Estoque
                    </button>
                    <div class="dropdown-menu">
                        <a class="navbar-brand" href="{{ url('/cadastros/fornecedores') }}">
                            Fornecedores
                        </a>
                        <a class="navbar-brand" href="{{ url('/estoque/compras') }}">
                            Compras
                        </a>
                        <a class="navbar-brand" href="{{ url('/estoque/balanco') }}">
                            Balanço
                        </a>
                        <a class="navbar-brand" href="{{ url('/estoque/cardex') }}">
                            Cárdex
                        </a>
                        <a class="navbar-brand" href="{{ url('/estoque/posicaoEstoque') }}">
                            Posição
                        </a> 
                    </div>
                </div> 
                <div class="btn-group ">
                    <button class="btn btn-lg" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Relatórios
                    </button>
                    <div class="dropdown-menu">
                        <a class="navbar-brand" href="{{ url('/relatorios/clients') }}">
                            Clientes
                        </a><br>
                        <a class="navbar-brand" href="{{ url('/relatorios/faturamento') }}">
                            Faturamento
                        </a><br>
                        <a class="navbar-brand" href="{{ url('/relatorios/receita') }}">
                            Receita
                        </a>
                        <a class="navbar-brand" href="{{ url('/relatorios/parcelas') }}">
                            Parcelas
                        </a> 
                    </div>
                </div>   
                <a class="navbar-brand" href="{{ url('/clients') }}">
                    Clientes
                </a>
                <a class="navbar-brand" href="{{ url('/incluir/clients') }}">
                    Incluir Clientes
                </a> 
            </div> 
                <a class="navbar-brand" href="{{url('/home')}}" id="imgApp">
                    <img src="{{url('icon/logo.png')}}" width="40" height="40"> 
                </a> 
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#logoff" >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="logoff">
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
        @yield('content') 
    </div>    
    <footer class="footer" style="background-color: #b0e0e6; font-size:21px;font-family: 'Katibeh', cursive;  opacity : 0.88; ">
        <div class="row">
            <div class="col-sm-2">
                <img src="{{url('icon/aladin.png')}}" width="90" height="50" style="margin-top: 5px; margin-left:70px;">  
            </div>
            <div class="col-sm-6">
                <label style="margin-top: 20px;">Versão 1.0.1</label>  
            </div> 
            <div class="col-sm-4">
                <label style="margin-top: 20px;">Follow Us</label>
                <a href="https://github.com/lucassantosf/gym_app_laravel">
                    <img src="{{url('icon/gitIco.png')}}" width="20" height="20"> 
                </a> 
                <a href="#">
                    <img src="{{url('icon/faceIco.png')}}" width="20" height="20"> 
                </a>
                <a href="#">
                    <img src="{{url('icon/instaIco.png')}}" width="20" height="20"> 
                </a>
                <a href="#">
                    <img src="{{url('icon/twitterIco.png')}}" width="20" height="20"> 
                </a>   
            </div>
        </div>  
    </footer> 
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"></link>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 
    @hasSection('javascript')
        @yield('javascript')
    @endif 
</body>
</html>