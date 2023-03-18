<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}">
	<link rel="stylesheet" href="{{ asset('css/app.css')}}">
    <link rel="stylesheet" href="{{ asset('css/estilos.css')}}">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
	<title>{{ $title }} - Controle de Séries</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('series.index') }}">Home</a>
        @auth
            <form action="{{ route('logout')}}" method="post">
                @csrf
                <button class="btn btn-link">
                    Sair
                </button>
            </form>
        @endauth
        @guest
            <a href="{{ route('login')}}">
                entrar
            </a>
        @endguest
    </div>
</nav>
	<div class="container">
		<h1>{{ $title }}</h1>

	    @isset($mensagemSucesso)
	    	<div class="alert alert-success">
	    		{{ $mensagemSucesso }}
	    	</div>
	    @endisset

		@if ($errors->any())
    		<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
    		</div>
		@endif
		{{ $slot }}
	</div>
</body>
</html>
