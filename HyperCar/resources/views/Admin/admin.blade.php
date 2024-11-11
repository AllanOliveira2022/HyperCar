
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Administração - Tema Escuro</title>

    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        display: flex;
        min-height: 100vh;
        font-family: Arial, sans-serif;
        background-color: #121212;
        color: #e0e0e0;
    }

    .sidebar {
        width: 250px;
        background-color: #37474f; /* Azul fosco para a barra lateral */
        color: #e0e0e0;
        padding-top: 20px;
        position: fixed;
        height: 100vh;
        overflow-y: auto;
    }

    .sidebar h2 {
        text-align: center;
        margin-bottom: 20px;
        font-size: 20px;
        color: #4fc3f7; /* Azul claro para destacar o título */
    }

    .sidebar p {
        text-align: center;
        color: #b0bec5;
        margin-bottom: 15px;
        font-size: 16px;
    }

    .sidebar a {
    text-align: center;
    display: block;
    padding: 12px 0;
    color: #ffffff;
    background-color: #1a252f; /* Azul ainda mais escuro para os botões */
    text-decoration: none;
    margin: 5px 20px;
    border-radius: 5px;
    font-weight: bold;
    transition: background 0.3s;
}

.sidebar a:hover {
    background-color: #2c3e50; /* Azul mais claro ao passar o mouse */
}

    .content {
        margin-left: 250px;
        padding: 20px;
        width: calc(100% - 250px);
        background-color: #1e1e1e;
    }

    .main-section {
        text-align: center;
    }

    .info-box {
        margin: 20px auto;
        width: 90%;
        background-color: #263238; /* Azul escuro */
        border: 1px solid #37474f;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
    }

    .info-box h3 {
        font-size: 24px;
        color: #4fc3f7;
        margin-bottom: 20px;
        width: 100%;
        text-align: left;
    }

    .info-item {
        flex: 1 1 200px;
        margin: 10px;
        padding: 10px;
        text-align: center;
        background-color: #37474f;
        border-radius: 8px;
        transition: transform 0.2s;
    }

    .info-item:hover {
        transform: translateY(-5px);
        background-color: #546e7a;
    }

    .info-item p {
        margin-bottom: 5px;
        font-size: 15px;
        color: #b0bec5;
    }

    .info-item strong {
        display: block;
        font-size: 20px;
        color: #81d4fa;
        margin-top: 5px;
    }

    .btn {
        display: inline-block;
        padding: 10px 15px;
        color: #ffffff;
        background-color: #37474f;
        text-decoration: none;
        border-radius: 5px;
        transition: background 0.3s;
    }

    .btn:hover {
        background-color: #546e7a;
    }

    .success-message {
        color: #c8e6c9;
        margin-top: 20px;
        font-size: 16px;
        padding: 10px;
        background-color: #388e3c; /* Verde escuro para mensagens de sucesso */
        border-radius: 5px;
        width: fit-content;
    }

    form button {
        display: inline-block;
        padding: 8px 12px;
        color: #ffffff;
        background-color: #d32f2f;
        border: none;
        border-radius: 5px;
        font-weight: bold;
        cursor: pointer;
        transition: background 0.3s;
        font-size: 14px;
        margin-top: 50px;
    }

    form button:hover {
        background-color: #b71c1c;
    }
</style>


</head>
<body>
@php
    $totalCarros = \App\Models\Carro::count();
    $totalCarrosDisponiveis = \App\Models\Carro::where('Disponibilidade', 1)->count(); 
    use Carbon\Carbon;
            
            // Obtém a data de início e fim do último mês
            $mesAtual = Carbon::now()->month;
            $anoAtual = Carbon::now()->year;

            // Conta o número de reservas feitas no mês e ano atual
            $quantidadeReservasMesAtual = \App\Models\Reserva::whereMonth('DataInicio', $mesAtual)->count();

            $dataHoje = Carbon::today();
            // Obtém as reservas com DataDevolucao igual a hoje
            $reservasParaDevolucaoHoje = \App\Models\Reserva::whereDate('DataFim', $dataHoje)
                                                            ->where('Estatus', 'Pendente')->get()->count();
       
@endphp
    <div class="sidebar">
        <h2>Painel de Administração</h2>
        <p>Bem-vindo, {{ auth()->user()->Nome }}!</p>
        <a href="{{ route('admin.carros.index') }}" class="btn">Listar Carros</a>
        <a href="{{ route('admin.carros.create') }}" class="btn">Cadastrar Novo Carro</a>
        <a href="{{ route('reservas.processarDevolucao') }}" class="btn">Fazer Devolução</a>
        <a href="{{ route('todas.reservas') }}" class="btn">Histórico de Reservas</a>
        
        <form action="{{ route('logout') }}" method="POST" style="text-align: center;">
            @csrf
            <button type="submit">Sair</button>
        </form>
    </div>

    <div class="content">
        <div class="main-section">
            <h1>Painel de Administração</h1>

            @if(session('success'))
                <div class="success-message">
                    {{ session('success') }}
                </div>
            @endif

            <div class="info-box">
                <h3>Informações Gerais</h3>
                <div class="info-item">
                    <p>Data de hoje:</p>
                    <strong>{{ \Carbon\Carbon::now()->format('d/m/Y') }}</strong>
                </div>
                <div class="info-item">
                    <p>Total de Carros Cadastrados:</p>
                    <strong>{{  $totalCarros ?? 0 }}</strong>
                </div>
                <div class="info-item">
                    <p>Carros Disponíveis:</p>
                    <strong>{{ $totalCarrosDisponiveis ?? 0 }}</strong>
                </div>
                <div class="info-item">
                    <p>Reservas nesse mês:</p>
                    <strong>{{ $quantidadeReservasMesAtual ?? 0 }}</strong>
                </div>
                <div class="info-item">
                    <p>Devoluções Marcadas para Hoje:</p>
                    <strong>{{ $reservasParaDevolucaoHoje ?? 0 }}</strong>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
