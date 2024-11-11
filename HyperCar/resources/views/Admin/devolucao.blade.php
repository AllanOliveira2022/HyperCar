<!-- devolucao.blade.php -->
<link rel="stylesheet" href="{{ asset('css/AdminCss/devolucao.css') }}">

<div class="container">
    <h1 class="mb-4">Devolução de Reservas</h1>

    <!-- Exibe a mensagem de sucesso, se houver -->
    @if(session('devolucao_sucesso'))
        <div class="alert alert-success mb-4" id="sucessoMensagem">
            {{ session('devolucao_sucesso') }}
        </div>
    @endif

    <div class="row">
        @forelse($reservasAtivas as $reserva)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Reserva #{{ $reserva->IdReserva }}</h5>
                        <p class="card-text">
                            <strong>Carro:</strong> {{ $reserva->carro->Modelo ?? 'N/A' }}<br>
                            <strong>Data de Início:</strong> {{ \Carbon\Carbon::parse($reserva->DataInicio)->format('d/m/Y') }}<br>
                            <strong>Data de Devolução (prevista):</strong> {{ \Carbon\Carbon::parse($reserva->DataFim)->format('d/m/Y') }}<br>
                            <strong>Cliente:</strong> {{ $reserva->Usuario->Nome ?? 'N/A' }} <!-- Exibe o nome do usuário -->
                        </p>
                        <form action="{{ route('reservas.devolver') }}" method="post">
                            @csrf
                            <input type="hidden" name="IdReserva" value="{{ $reserva->IdReserva }}">
                            <div class="form-group">
                                <label for="dataDevolucao">Data de Devolução Real:</label>
                                <input type="date" class="form-control" id="dataDevolucao" name="dataDevolucao" required>
                            </div>
                            <button type="submit" class="btn btn-danger">Confirmar Devolução</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">Nenhuma reserva ativa encontrada.</p>
        @endforelse
    </div>

    <!-- Botão Voltar -->
    <a href="{{ route('admin') }}" class="btn btn-primary voltar-btn">Voltar</a>
</div>

<!-- Script para esconder a mensagem após 1 segundo -->
<script>
    window.onload = function() {
        // Verifica se a mensagem de sucesso está presente
        let sucessoMensagem = document.getElementById('sucessoMensagem');
        if (sucessoMensagem) {
            // Define um timeout para remover a mensagem após 1 segundo (1000ms)
            setTimeout(function() {
                sucessoMensagem.style.display = 'none';
            }, 1000);
        }
    }
</script>
