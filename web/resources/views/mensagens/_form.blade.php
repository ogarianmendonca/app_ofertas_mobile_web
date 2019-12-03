<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Para</label>
            <select class="form-control" id="para" name="para">
                <option>Selecione</option>
                @foreach($para as $to)
                    <option value="{{$to->id}}">{{$to->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            <label>Mensagem</label>
            <textarea class="form-control" name="mensagem" cols="20" rows="5" required></textarea>
        </div>
    </div>
</div>







