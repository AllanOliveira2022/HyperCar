<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Todas as Reservas</title>

    <!-- Link para o arquivo CSS externo -->
    <link rel="stylesheet" href="{{ asset('css/AdminCss/historico.css') }}">
</head>
<body>
    <div class="container">
        <!-- Botão Voltar no topo esquerdo -->
        <a href="{{ route('admin') }}" class="btn btn-back">Voltar</a>

        <header>
            <h1>Todas as Reservas</h1>
        </header>

        <section class="reservas">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuário</th>
                        <th>Carro</th>
                        <th>Data de Início</th>
                        <th>Data de Fim</th>
                        <th>Status</th>
                        <th>Data de Devolução</th>
                        <th>Valor Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservas as $reserva)
                        <tr>
                            <td>{{ $reserva->IdReserva}}</td>
                            <td>{{ $reserva->usuario->Nome }}</td>
                            <td>{{ $reserva->carro ? $reserva->carro->Modelo : 'Carro não encontrado' }}</td>
                            <td>{{ \Carbon\Carbon::parse($reserva->DataInicio)->format('d/m/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($reserva->DataFim)->format('d/m/Y') }}</td>
                            <td class="
    {{ $reserva->Estatus == 'Devolvido' ? 'text-success' : 
       ($reserva->Estatus == 'Pendente' ? 'text-pendente' : 'text-danger') }}">
    {{ $reserva->Estatus }}
</td>
                            <td>{{ $reserva->DataDevolucao ? \Carbon\Carbon::parse($reserva->DataDevolucao)->format('d/m/Y') : '-' }}</td>
                            <td>R$ {{ number_format($reserva->ValorTotal, 2, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </div>
</body>
</html>
