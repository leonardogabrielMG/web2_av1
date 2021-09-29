@extends("template.master")

@section("titulo", "Cadastro")

@section("cadastro")
	<form method="POST" action="/animal" class="row">

		@csrf
		<input type="hidden" id="id" name="id" value="{{ $animal->id }}"/>
		<h1>CADASTRO</h1>
		<div class="form-group col-6">
			<label for="nomeAnimal">Nome do animal: </label>
			<input type="text" name="nomeAnimal" name="nomeAnimal" value="{{ $animal->nomeAnimal }}" class="form-control" />
		</div>
		<div class="form-group col-6">
			<label for="nomeDono">Nome do dono: </label>
			<input type="text" name="nomeDono" name="nomeDono" value="{{ $animal->nomeDono }}" class="form-control"/>
		</div>
		<div class="form-group col-6">
			<label for="raca">Raça: </label>
			<input type="text" name="raca" name="raca" value="{{ $animal->raca }}" class="form-control"/>
		</div>
		<div class="form-group col-6">
			<label for="dataNascimento">Data de Nascimento: </label>
			<input type="date" name="dataNascimento" name="dataNascimento" value="{{ $animal->dataNascimento }}" class="form-control"/>
		</div>
		<div class="form-group col-6">
			<label for="especie">Especie: </label>
			<select name="nomeEspecie" class="form-control">
				<option value=""></option>
				@foreach($especies as $especie)
				@if($especie->id == $animal->especie)
					<option value="{{ $especie->id }}" selected="selected">{{ $especie->nomeEspecie }}</option>
				@else
					<option value="{{ $especie->id }}" >{{ $especie->nomeEspecie }}</option>
				@endif
				@endforeach
			</select>
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
				<th>Nome</th>
				<th>Idade</th>
				<th>Especie</th>
				<th>Editar</th>
				<th>Excluir</th>
			</tr>
		</thead>
		<tbody>
			@foreach($animais as $animal)
			<tr>
				<td>{{ $animal->nomeAnimal }}</td>
				<td>{{ $animal->idade }}</td>
				<td>{{ $animal->especie }}</td>
				<td>
					<a href="/animal/{{ $animal->id }}/edit" class="btn btn-warning">Editar</a>
				</td>
				<td>
					<form action="/animal/{{ $animal->id }}" method="POST">
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