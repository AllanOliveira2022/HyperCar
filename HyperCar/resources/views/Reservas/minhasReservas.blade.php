<link rel="stylesheet" href="{{ asset('css/generic.css') }}">
<link rel="stylesheet" href="{{ asset('css/ReservaCss/minhasReservas.css') }}">

<h1>Minhas Reservas</h1>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table">
    <thead>
        <tr>
            <th>Carro</th>
            <th>Data Início</th>
            <th>Data Fim</th>
            <th>Status</th>
            <th>Data Devolução</th>
            <th>Valor Total</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($reservas as $reserva)
        <tr class="{{ $reserva->Estatus == 'Devolvido' ? 'table-secondary text-muted' : '' }}">
        <td>{{ $reserva->carro ? $reserva->carro->Modelo : 'Carro não encontrado' }}</td>
                <td>{{ $reserva->DataInicio }}</td>
                <td>{{ $reserva->DataFim }}</td>
                <td>{{ $reserva->Estatus }}</td>
                <td>{{ $reserva->DataDevolucao }}</td>
                <td>{{ $reserva->ValorTotal }}</td>
                <td>
                    @if ($reserva->Estatus != 'Devolvido')
                        <a href="{{ route('reservas.edit', $reserva->IdReserva) }}">Editar</a>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<a href="{{ route('inicio') }}">voltar</a>