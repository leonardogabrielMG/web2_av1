<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>PETSHOP - @yield("titulo")</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">
</head>
<body>

	<nav class="navbar navbar-expand-sm bg-light">

		<ul class="navbar-nav">
			<img src="{{ asset('img/destaqueestilosos1.png') }}" alt="Logo" style="width:50px;">
    		<li class="nav-item">
      			<a class="nav-link" href="/">Home</a>
    		</li>
    		<li class="nav-item">
      			<a class="nav-link" href="/animal">Animal</a>
    		</li>
    		<li class="nav-item">
      			<a class="nav-link" href="/especie">Especie</a>
    		</li>
  		</ul>

	</nav>

	@if (Session::get("acao") == "salvo")
		<div class="alert alert-success">
			Salvo com sucesso!
		</div>
	@endif
	@if (Session::get("acao") == "excluido")
		<div class="alert alert-danger">
			Excluido com sucesso!
		</div>
	@endif

	<div class="container">
		<div>
			@yield("cadastro")
		</div>
		<div>
			@yield("lista")
		</div>
		<div>
			@yield("apresentacao")
		</div>
	</div>
</body>
</html>