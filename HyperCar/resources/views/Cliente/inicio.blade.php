<link rel="stylesheet" href="{{ asset('css/generic.css') }}">
<link rel="stylesheet" href="{{ asset('css/ClienteCss/inicio.css') }}">

<p>você está logado<p>
<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Sair</button>
</form>

<h1>reservar</h1>
<a href="{{ route('reservas.index') }}">Reservar</a> 
