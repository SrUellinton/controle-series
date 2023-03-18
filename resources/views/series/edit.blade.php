<x-layout title="Editar Série - {!! $serie->nome !!}">
      <form action="{{ route('series.update', $serie->id) }}" method="POST">
        @csrf
        <div class="row mb-3">
           <div class="col-8">
               <label for="nome" class="form-label">Nome:</label>
               <input type="text" 
               autofocus
                     id="nome" 
                     name="nome" 
                     class="form-control"
                     value="{{$serie->nome}}">
           </div>
           <div class="col-2">
               <label for="seasons" class="form-label">N° Temporada:</label>
               <input type="text" 
                     id="seasonsQty" 
                     name="seasonsQty" 
                     class="form-control"
                     value="{{$serie->seasons->count()}}">
           </div>
           <div class="col-2">
               <label for="episodesPerSeason" class="form-label">Eps / Temporada:</label>
               <input type="text" 
                     id="episodesPerSeason" 
                     name="episodesPerSeason" 
                     class="form-control"
                     value="{{$season->episodes->count()}}">
           </div>
        </div>
        <button type="submit" class="btn btn-primary">Adicionar</button>
    </form>
</x-layout>