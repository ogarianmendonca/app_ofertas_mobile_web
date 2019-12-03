<div class="form-group{{ $errors->has('imagem') ? ' has-error' : '' }}">
    <label for="name" class="col-md-4 control-label">Imagem</label>   
    
    <div class="col-md-6">
        @if(isset($user->imagem))
            <img src="{{ asset($user->imagem) }}" alt="" height="60">
            <input type="file" class="form-control" name="imagem">
        @else
            <input type="file" class="form-control" name="imagem" required>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label for="name" class="col-md-4 control-label">Nome</label>

    <div class="col-md-6">
        <input id="name" type="text" class="form-control" name="name" value="{{ isset($user->name) ? $user->name : '' }}" required autofocus>

        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
    <label for="email" class="col-md-4 control-label">E-mail</label>

    <div class="col-md-6">
        <input id="email" type="email" class="form-control" name="email" value="{{ isset($user->email) ? $user->email : '' }}" required>

        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
    <label for="password" class="col-md-4 control-label">Senha</label>

    <div class="col-md-6">
        <input id="password" type="password" class="form-control" name="password" >

        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group">
    <label for="password-confirm" class="col-md-4 control-label">Confirmar Senha</label>

    <div class="col-md-6">
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" >
    </div>
</div>