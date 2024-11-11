
<h1>Editar Reserva</h1>

<form action="{{ route('reservas.update', $reserva->IdReserva) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="IdCarro">Carro:</label>
    <select name="IdCarro" required>
        @foreach ($carrosDisponiveis as $carro)
            <option value="{{ $carro->IdCarro }}" {{ $carro->IdCarro == $reserva->IdCarro ? 'selected' : '' }}>
                {{ $carro->Modelo }} - R$ {{ $carro->PrecoDiaria }} / dia
            </option>
        @endforeach
    </select>

    <label for="DataInicio">Data Início:</label>
    <input type="date" name="DataInicio" value="{{ $reserva->DataInicio }}" required>

    <label for="DataFim">Data Fim:</label>
    <input type="date" name="DataFim" value="{{ $reserva->DataFim }}" required>

    <button type="submit">Atualizar Reserva</button>
</form>
<a href="{{ route('inicio') }}">voltar</a> 
