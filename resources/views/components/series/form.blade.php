    <form action="{{$action}}" method="POST">
        @csrf
        @if($update)
            @method('PUT')
        @endif
        <div class="mb-3">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" id="nome" name="nome" class="form-control" 
            @isset($nome) value="{{$nome}}" @endisset>
        </div>
        <button type="submit" class="btn btn-primary">
            @if(isset($nome)) 
                Atualizar 
            @else 
                Adicionar 
            @endif
        </button>
    </form>