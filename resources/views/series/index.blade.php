<x-layout title="{{ __('messages.app_name') }}">
	<a class="btn btn-dark mb-2" href="{{route('series.create')}}">Adicionar Série</a>
	@isset($mensagemSucesso)
		<div class="alert alert-success">
			{{ $mensagemSucesso }}
		</div>
	@endisset
	<ul class="list-group">
		@foreach ( $series as $serie)
			<li class="list-group-item d-flex justify-content-between align-items-center">
				<a href="{{route('seasons.index', $serie->id)}}">{{ $serie->nome }}</a>
				<span class="d-flex">
					<a class="btn btn-primary btn-sm ml-5" href="{{route('series.edit',$serie->id)}}">
						<span class="material-symbols-outlined mt-1"> edit_note</span>
					</a>
					<form action="{{ route('series.destroy', $serie->id) }}" method="post">
						@csrf
						@method('DELETE')
						<span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Deletar Série">
							<button class="btn btn-danger btn-sm ms-2" >
								  <span class="material-symbols-outlined mt-1">delete</span>
							</button>
						</span>
					</form>
				</span>
			</li>
		@endforeach
	</ul>
</x-layout>