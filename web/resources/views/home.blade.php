@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            Bem-vindo, {{ Auth::user()->name }}!
        </div>
    </div>
</div>
@endsection
