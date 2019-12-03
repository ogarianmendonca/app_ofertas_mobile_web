<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Título</label>
            <input type="text" class="form-control" name="titulo" value="{{ isset($oferta->titulo) ? $oferta->titulo : ''}}" required>
        </div>

        <div class="form-group">
            <label>Descrição</label>
            <textarea class="form-control" name="descricao" cols="20" rows="5" required>{{ isset($oferta->descricao) ? $oferta->descricao : ''}}</textarea>
        </div>

        <div class="form-group">
            <label>Valor (ex:9.99)</label>
            <input type="number" step="any" class="form-control" name="valor" value="{{ isset($oferta->valor) ? $oferta->valor : ''}}" required>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>Validade</label>
            <input type="date" class="form-control" name="validade" value="{{ isset($oferta->validade) ? $oferta->validade : ''}}" required>
        </div>

        @if(isset($oferta->imagem))
            <img src="{{ asset($oferta->imagem) }}" alt="" height="60">
            <div class="form-group">
                <label>Imagem</label>
                <input type="file" class="form-control" name="imagem">
            </div>
        @else
            <div class="form-group">
                <label>Imagem</label>
                <input type="file" class="form-control" name="imagem" required>
            </div>
        @endif
    </div>
</div>







