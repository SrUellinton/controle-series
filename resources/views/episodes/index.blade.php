<x-layout title="Episódios" :mensagem-sucesso="$mensagemSucesso">
	<form method="post">
		@csrf
		<ul class="list-group">
			@foreach ($episodes as $episode)
			@csrf
				<li class="list-group-item d-flex justify-content-between align-items-center">
					Episódio {{ $episode->number }}

					<input type="checkbox"
						name="episodes[]"
						class="form-check-input"
						value="{{ $episode->id }}"
						@if ($episode->watched) checked @endif
					>
				</li>
			@endforeach
		</ul>
		<button class="btn btn-primary my-2">Salvar</button>
	</form>
</x-layout>
