@extends("template.master")

@section("titulo", "Cadastro de Espécie")

@section("cadastro")

	<form action="/especie" method="POST" class="row">
		
		@csrf

		<input type="hidden" name="id" value="{{ $especie->id }}">

		<h1>Cadastro</h1>

		<div class="form-group col-6">
			<label for="nomeEspecie">Espécie:</label>
			<input type="text" name="nomeEspecie" value="{{ $especie->nomeEspecie }}" class="form-control">
		</div>
		<div class="col-6">
			<button type="submit" class="btn btn-success bottom">Salvar</button>
			<a href="/animal" class="btn btn-primary bottom">Novo</a>
		</div>
	</form>

@endsection

@section("lista")
	<h1>Lista</h1>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Especie</th>
				<th>Editar</th>
				<th>Excluir</th>
			</tr>
		</thead>
		<tbody>
			@foreach($especies as $especie)
			<tr>
				<td>{{ $especie->nomeEspecie }}</td>
				<td>
					<a href="/especie/{{ $especie->id }}/edit" class="btn btn-warning">Editar</a>
				</td>
				<td>
					<form action="/especie/{{ $especie->id }}" method="POST">
						@csrf
						<input type="hidden" name="_method" value="DELETE"/>
						<button type="submit" class="btn btn-danger" onclick="return confirm('Deseja realmente excluir?');">Excluir</button>
					</form>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
@endsection