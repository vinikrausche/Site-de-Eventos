<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- CSS -->
        <link rel="stylesheet" href="/css/estilo.css"/>

        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

      


        
        </style>

    </head>
    <body >
        <header>
            <nav class=" navbar navbar-expand-lg navbar-light">
                <div class="collapse navbar-collapse" id="navbar2">
                    <a href="/" class="navbar-brand">
                        <img src="/img/code.png" alt="" id="logo"/>
                    </a>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="/" class="nav-link">Eventos</a>
                        </li>
                        <li class="nav-item">
                            <a href="/events/create" class="nav-link">Criar Eventos</a>
                        </li>

                        @auth
                        <li class="nav-item">
                            <a class="nav-link" href="/dashboard">Meus Eventos</a>
                        </li>
                        <li>
                            <form method="POST" action="/logout">
                                @csrf
                                <a href="/logout" class="nav-link" onclick="event.preventDefault(); this.closest('form').submit();">Sair</a>
                            </form>
                            
                        </li>
                        @endauth
                        @guest
                        <li class="nav-item">
                            <a href="/login" class="nav-link">Entrar</a>
                        </li>
                        <li class="nav-item">
                            <a href="/register" class="nav-link">Cadastrar</a>
                        </li>
                        @endguest
                    </ul>
                </div>
            </nav>
        </header>

        @if(session('msg'))
            <script>
                window.alert('Evento criado com sucesso!');
            </script>
            
        @endif
        @yield('content')

        <footer>
            <p id="rodape">HDC Events &copy 2021 - Todos os direitos reservados</p>
        </footer>
    </body>
</html>
