<link rel="stylesheet" href="{{ asset('css/generic.css') }}">
<link rel="stylesheet" href="{{ asset('css/ClienteCss/inicio.css') }}">

<div class="main">
<p>Bem-vindo, {{ auth()->user()->Nome }}!</p>
<h1>reservar</h1>
<a href="{{ route('reservas.index') }}">Reservar</a> 

<h1>Ver reservas</h1>
<a href="{{ route('reservas.minhas') }}">ver</a> 
<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Sair</button>
</form>
</div>