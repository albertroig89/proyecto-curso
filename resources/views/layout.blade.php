<!doctype html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.79.0">
    <title>@yield('title') - WEB LARAVEL</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sticky-footer-navbar/">

    

    <!-- Bootstrap core CSS -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/open-iconic/1.1.1/font/css/open-iconic-bootstrap.min.css" integrity="sha256-BJ/G+e+y7bQdrYkS2RBTyNfBHpA9IuGaPmf9htub5MQ=" crossorigin="anonymous" />

      {{--      <link href="/open-iconic/font/css/open-iconic-bootstrap.css" rel="stylesheet">--}}
{{--      <link rel="stylesheet" href="@icon/open-iconic/open-iconic.css">--}}
      <link href="{{ asset('css/app.css') }}" rel="stylesheet">


      <!-- Favicons -->
      <link  rel="icon"   href="{{ asset('/images/favicon.png') }}" type="image/png" />

    <meta name="theme-color" content="#7952b3">


{{--    <style>--}}
{{--      .bd-placeholder-img {--}}
{{--        font-size: 1.125rem;--}}
{{--        text-anchor: middle;--}}
{{--        -webkit-user-select: none;--}}
{{--        -moz-user-select: none;--}}
{{--        user-select: none;--}}
{{--      }--}}

{{--      @media (min-width: 768px) {--}}
{{--        .bd-placeholder-img-lg {--}}
{{--          font-size: 3.5rem;--}}
{{--        }--}}
{{--      }--}}
{{--    </style>--}}

    
    <!-- Custom styles for this template -->
{{--    <link href="{{ asset('css/style.css') }}" rel="stylesheet">--}}
  </head>
  <body class="d-flex flex-column h-100">
    
<header>
  <!-- Fixed navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Curso de laravel 5.5</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item active">
            <a class="nav-link" aria-current="page" href="#">@yield('title')</a>
          </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Usuarios
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('users.index') }}">Mostrar usuarios</a>
                    <a class="dropdown-item" href="{{ route('users.create') }}">Nuevo usuario</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Otros
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="../../saludo/albert">Saludo</a>
                    <a class="dropdown-item" href="../../saludo/albert/sdarcknes">Saludo Nickname</a>
                </div>
            </li>
        </ul>
        <!--<form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>-->
      </div>
    </div>
  </nav>
</header>

<!-- Begin page content -->
<main class="flex-shrink-0">

    <div class="pt-5 mt-2 col-12">
        @yield('content')
    </div>

</main>

<footer class="footer mt-auto py-3 bg-light">
  <div class="container">
    <span class="text-muted">Proyecto curso Styde Albert Roig</span>
  </div>
</footer>

<script src="{{ asset('js/app.js') }}"></script>


<script>
    $(document).ready(function(){
        @section('jquery')
        console.log('Template: layout.blade.php');
        @show
    });
</script>

  </body>
</html>
